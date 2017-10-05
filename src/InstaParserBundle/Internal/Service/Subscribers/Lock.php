<?php

namespace InstaParserBundle\Internal\Service\Subscribers;

use Doctrine\ORM\EntityManagerInterface;
use InstaParserBundle\Entity\Repository\FactoryInterface;
use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Interaction\Dto\Request\CollectionRequest;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Enum\UpdateStatus;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Internal\Service\ServiceInterface;
use Psr\Log\LoggerInterface;

final class Lock extends BaseEntityService
{
    /**
     * @var ServiceInterface
     */
    private $service;

    /**
     * @param EntityManagerInterface $entityManager
     * @param FactoryInterface $repositoryFactory
     * @param ServiceInterface $service
     * @param LoggerInterface $logger
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FactoryInterface $repositoryFactory,
        ServiceInterface $service,
        LoggerInterface $logger
    ) {
        parent::__construct($entityManager, $repositoryFactory, $logger);

        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|CollectionRequest $request
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        $this->logger->info('Locking subscribers');
        $this->setSubscriberStatus($request->getCollection(), UpdateStatus::inProgress());

        $response = $this->service->behave($request);

        return $response;
    }

    /**
     * @param Subscriber[] $subscribers
     * @param UpdateStatus $status
     * @return void
     */
    private function setSubscriberStatus(array $subscribers, UpdateStatus $status)
    {
        array_map(
            function(Subscriber $subscriber) use ($status) {
                $subscriber->setStatus($status->getValue());
            },
            $subscribers
        );

        $this->entityManager->flush();
    }
}