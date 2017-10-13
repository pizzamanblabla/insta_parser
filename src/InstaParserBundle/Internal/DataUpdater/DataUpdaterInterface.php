<?php

namespace InstaParserBundle\Internal\DataUpdater;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;

interface DataUpdaterInterface
{
    /**
     * @param InternalRequestInterface $request
     * @param InternalResponseInterface $response
     * @return void
     */
    public function update(InternalRequestInterface $request, InternalResponseInterface $response);
}