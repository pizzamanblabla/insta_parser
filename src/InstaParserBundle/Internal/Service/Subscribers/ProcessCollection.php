<?php

namespace InstaParserBundle\Internal\Service\Subscribers;

use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Request\SubscriberRequest;
use InstaParserBundle\Interaction\Dto\Request\SubscribersRequest;
use InstaParserBundle\Interaction\Dto\Response\EmptyInnerSuccessfulResponse;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\DataUpdater\DataUpdaterInterface;
use InstaParserBundle\Internal\Service\ServiceInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

final class ProcessCollection implements ServiceInterface
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
     * @param LoggerInterface $logger
     */
    public function __construct(
        ServiceInterface $decoratedService,
        DataUpdaterInterface $dataUpdater,
        LoggerInterface $logger
    ) {
        $this->setLogger($logger);

        $this->decoratedService = $decoratedService;
        $this->dataUpdater = $dataUpdater;
    }

    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|SubscribersRequest $request
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        foreach ($request->getSubscribers() as $subscriber) {
            $subscriberRequest = $this->createInternalRequest($subscriber);
            $response = $this->decoratedService->behave($subscriberRequest);

            $this->dataUpdater->update($subscriberRequest, $response);
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