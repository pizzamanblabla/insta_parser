<?php

namespace InstaParserBundle\Interaction\Dto\Request;

final class CollectionRequestFactory implements InternalRequestFactoryInterface
{
    /**
     * @return InternalRequestInterface
     */
    public function createRequest(): InternalRequestInterface
    {
        return new CollectionRequest();
    }
}