<?php

namespace InstaParserBundle\Operation\Statistics\Update\Subscriber\Service;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\EmptyInnerErroneousResponse;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\RemoteCall\RemoteCallInterface;
use InstaParserBundle\Internal\Service\ServiceInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

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
        } catch (Exception $e) {
            return new EmptyInnerErroneousResponse($e);
        }
    }
}