<?php

namespace InstaParserBundle\Operation\Statistics\Update\Collection\Service;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use InstaParserBundle\Entity\Brand;
use InstaParserBundle\Entity\Mention;
use InstaParserBundle\Entity\Repository\FactoryInterface;
use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\EmptyInnerSuccessfulResponse;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Enum\UpdateStatus;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Internal\Service\ServiceInterface;
use InstaParserBundle\Operation\Statistics\Update\Collection\Dto\Request\Request;
use InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Request\Request as SubscriberRequest;
use InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Response\SuccessfulResponse;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

final class Service extends BaseEntityService
{
    use LoggerAwareTrait;

    /**
     * @var ServiceInterface
     */
    private $decoratedService;

    /**
     * @param ServiceInterface $decoratedService
     * @param EntityManagerInterface $entityManager
     * @param FactoryInterface $repositoryFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ServiceInterface $decoratedService,
        EntityManagerInterface $entityManager,
        FactoryInterface $repositoryFactory,
        LoggerInterface $logger
    ) {
        parent::__construct($entityManager, $repositoryFactory, $logger);

        $this->setLogger($logger);

        $this->decoratedService = $decoratedService;
    }

    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|Request $request
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        foreach ($request->getSubscribers() as $subscriber) {
            $response = $this->decoratedService->behave($this->createInternalRequest($subscriber));

            if (!$response->getType()->isSuccessful()) {
                $subscriber->setStatus(UpdateStatus::FAILED);
            } else {
                $subscriber
                    ->setStatus(UpdateStatus::READY)
                    ->setUpdatedAt(new DateTime())
                ;

                $this->updateMentions($response, $subscriber);
            }
        }

        return new EmptyInnerSuccessfulResponse();
    }

    /**
     * @param Subscriber $subscriber
     * @return SubscriberRequest
     */
    private function createInternalRequest(Subscriber $subscriber): SubscriberRequest
    {
        return (new SubscriberRequest())->setSubscriber($subscriber);
    }

    /**
     * @param InternalResponseInterface|SuccessfulResponse $response
     * @param Subscriber $subscriber
     */
    private function updateMentions(InternalResponseInterface $response, Subscriber $subscriber)
    {
        foreach ($response->getPublications() as $publication) {
            if (!empty($publication->getCaption())) {
                $brands = $this->findBrands($publication->getCaption());
                $brandPool = [];

                foreach ($brands as $brandName) {
                    $brand = $this->getOrCreateBrand($brandName);

                    if (!in_array($brandName, $brandPool)) {
                        $brandPool[] = $brandName;

                        $this->updateMention(
                            (new DateTime())->modify('@' . $publication->getTimestamp()),
                            $brand,
                            $subscriber
                        );
                    }
                }
            }
        }
    }

    /**
     * @param string $caption
     * @return string[]
     */
    private function findBrands(string $caption): array
    {
        $result = preg_match_all('/@[^\s()!\'"\/\\\#\?\:\,\n\t]+/ui', $caption, $match);

        return $result ? $match[0] : [];
    }

    /**
     * @param string $name
     * @return Brand
     */
    private function getOrCreateBrand(string $name): Brand
    {
        $brand = $this->repositoryFactory->brand()->findOneByName($name);

        if (!$brand) {
            $brand = (new Brand())->setName($name);

            $this->entityManager->persist($brand);
            $this->entityManager->flush();
        }

        return $brand;
    }

    /**
     * @param DateTime $date
     * @param Brand $brand
     * @param Subscriber $subscriber
     * @return void
     */
    private function updateMention(DateTime $date, Brand $brand, Subscriber $subscriber)
    {
        if (!$this->repositoryFactory->mention()->findOneByDateAndBrandAndSubscriber($date, $brand, $subscriber)) {
            $mention = (new Mention())
                ->setBrand($brand)
                ->setSubscriber($subscriber)
                ->setDate($date)
            ;

            $this->entityManager->persist($mention);
        }
    }
}