<?php

namespace InstaParserBundle\Interaction\RemoteCall;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;

interface RemoteCallInterface
{
    /**
     * @param InternalRequestInterface $request
     * @return InternalResponseInterface
     */
    public function call(InternalRequestInterface $request): InternalResponseInterface;
}