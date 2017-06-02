<?php

namespace ParserBundle\Interaction\Protocol;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

interface RemoteCallInterface
{
    /**
     * @param InternalRequestInterface $request
     * @return
     */
    public function call(InternalRequestInterface $request);
}