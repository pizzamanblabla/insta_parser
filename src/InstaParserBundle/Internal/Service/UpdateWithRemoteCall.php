<?php

namespace InstaParserBundle\Internal\Service;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\EmptyInnerErroneousResponse;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\RemoteCall\RemoteCallInterface;
use InstaParserBundle\Internal\DataUpdater\DataUpdaterInterface;
use InstaParserBundle\Internal\DataUpdater\Exceptional\ExceptionalDataUpdaterInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Throwable;

final class UpdateWithRemoteCall implements ServiceInterface
{
    use LoggerAwareTrait;

    /**
     * @var RemoteCallInterface
     */
    private $remoteCall;

    /**
     * @var DataUpdaterInterface
     */
    private $dataUpdater;

    /**
     * @var ExceptionalDataUpdaterInterface
     */
    private $exceptionalDataUpdater;

    /**
     * @param RemoteCallInterface $remoteCall
     * @param DataUpdaterInterface $dataUpdater
     * @param ExceptionalDataUpdaterInterface $exceptionalDataUpdater
     * @param LoggerInterface $logger
     */
    public function __construct(
        RemoteCallInterface $remoteCall,
        DataUpdaterInterface $dataUpdater,
        ExceptionalDataUpdaterInterface $exceptionalDataUpdater,
        LoggerInterface $logger
    ) {
        $this->setLogger($logger);

        $this->remoteCall = $remoteCall;
        $this->dataUpdater = $dataUpdater;
        $this->exceptionalDataUpdater = $exceptionalDataUpdater;
    }

    /**
     * {@inheritdoc}
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        try {
            return $this->processOperation($request);
        } catch (Throwable $e) {
            $this->logger->warning(substr($e->getMessage(), 0, 250));
            $this->exceptionalDataUpdater->update($request,$e->getMessage());

            return new EmptyInnerErroneousResponse();
        }
    }

    /**
     * @param InternalRequestInterface $request
     * @return InternalResponseInterface
     */
    private function processOperation(InternalRequestInterface $request): InternalResponseInterface
    {
        $this->logger->info('Performing remote call');
        $response = $this->remoteCall->call($request);

        if ($response->getType()->isSuccessful()) {
            $this->logger->info('Updating database with received data');
            $this->dataUpdater->update($request, $response);
        }

        return $response;
    }
}