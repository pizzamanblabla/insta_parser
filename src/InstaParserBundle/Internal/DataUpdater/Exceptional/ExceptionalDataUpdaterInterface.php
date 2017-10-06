<?php

namespace InstaParserBundle\Internal\DataUpdater\Exceptional;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

interface ExceptionalDataUpdaterInterface
{
    /**
     * @param InternalRequestInterface $request
     * @return void
     */
    public function update(InternalRequestInterface $request);
}