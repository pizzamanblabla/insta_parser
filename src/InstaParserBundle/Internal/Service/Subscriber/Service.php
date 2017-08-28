<?php

namespace InstaParserBundle\Internal\Service\Subscriber;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\EmptyInnerErroneousResponse;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\RemoteCall\RemoteCallInterface;
use InstaParserBundle\Internal\Service\ServiceInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Throwable;

final class Service implements ServiceInterface
{
    use LoggerAwareTrait;

    /**
     * @var RemoteCallInterface
     */
    private $remoteCall;

    /**
     * @param RemoteCallInterface $remoteCall
     * @param LoggerInterface $logger
     */
    public function __construct(RemoteCallInterface $remoteCall, LoggerInterface $logger)
    {
        $this->setLogger($logger);
        $this->remoteCall = $remoteCall;
    }

    /**
     * {@inheritdoc}
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        try {
            return $this->remoteCall->call($request);
        } catch (Throwable $e) {
            $this->logger->warning(substr($e->getMessage(), 0, 250));

            return new EmptyInnerErroneousResponse($e);
        }
    }
}