<?php

namespace InstaParserBundle\Internal\DataUpdater\Exceptional;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

interface ExceptionalDataUpdaterInterface
{
    /**
     * @param InternalRequestInterface $request
     * @param string $errorMessage
     * @return void
     */
    public function update(InternalRequestInterface $request, string $errorMessage);
}