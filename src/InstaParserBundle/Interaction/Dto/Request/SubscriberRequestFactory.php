<?php

namespace InstaParserBundle\Interaction\Dto\Request;

final class SubscriberRequestFactory implements InternalRequestFactoryInterface
{
    /**
     * @return InternalRequestInterface
     */
    public function createRequest(): InternalRequestInterface
    {
        return new SubscriberRequest();
    }
}