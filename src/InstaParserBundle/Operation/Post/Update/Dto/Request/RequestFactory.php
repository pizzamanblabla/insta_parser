<?php

namespace InstaParserBundle\Operation\Post\Update\Dto\Request;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestFactoryInterface;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

final class RequestFactory implements InternalRequestFactoryInterface
{
    /**
     * @return InternalRequestInterface
     */
    public function createRequest(): InternalRequestInterface
    {
        return new Request();
    }
}