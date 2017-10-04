<?php

namespace InstaParserBundle\Interaction\Dto\Request;

interface InternalRequestFactoryInterface
{
    /**
     * @return InternalRequestInterface
     */
    public function createRequest(): InternalRequestInterface;
}