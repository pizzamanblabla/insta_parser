<?php

namespace InstaParserBundle\Operation\Statistics\Update\Service;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\Service\ServiceInterface;
use ParserBundle\Interaction\Protocol\RemoteCallInterface;

final class Service implements ServiceInterface
{
    /**
     * @var RemoteCallInterface
     */
    private $remoteCall;

    /**
     * {@inheritdoc}
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        $response = $this->remoteCall->call($request);
    }
}