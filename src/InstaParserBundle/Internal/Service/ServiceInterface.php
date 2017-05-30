<?php

namespace InstaParserBundle\Internal\Service;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;

interface ServiceInterface
{
    /**
     * @param InternalRequestInterface $request
     * @return InternalResponseInterface
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface;
}