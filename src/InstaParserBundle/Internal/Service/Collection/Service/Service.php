<?php

namespace InstaParserBundle\Internal\Service\Collection\Service;

use Doctrine\ORM\EntityManagerInterface;
use InstaParserBundle\Entity\Repository\FactoryInterface;
use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\EmptyInnerSuccessfulResponse;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\DataUpdater\DataUpdaterInterface;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Internal\Service\Collection\Dto\Request\Request;
use InstaParserBundle\Internal\Service\ServiceInterface;
use InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Request\Request as SubscriberRequest;
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
     * @var DataUpdaterInterface
     */
    private $dataUpdater;

    /**
     * @param ServiceInterface $decoratedService
     * @param DataUpdaterInterface $dataUpdater
     * @param EntityManagerInterface $entityManager
     * @param FactoryInterface $repositoryFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ServiceInterface $decoratedService,
        DataUpdaterInterface $dataUpdater,
        EntityManagerInterface $entityManager,
        FactoryInterface $repositoryFactory,
        LoggerInterface $logger
    ) {
        parent::__construct($entityManager, $repositoryFactory, $logger);

        $this->setLogger($logger);

        $this->decoratedService = $decoratedService;
        $this->dataUpdater = $dataUpdater;
    }

    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|Request $request
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        foreach ($request->getSubscribers() as $subscriber) {
            $response = $this->decoratedService->behave($this->createInternalRequest($subscriber));

            $this->dataUpdater->update($response);
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
}