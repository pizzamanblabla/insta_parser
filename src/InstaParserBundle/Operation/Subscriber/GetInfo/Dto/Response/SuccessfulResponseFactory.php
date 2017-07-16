<?php

namespace InstaParserBundle\Operation\Subscriber\GetInfo\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Response\ResponseFactoryInterface;

final class SuccessfulResponseFactory implements ResponseFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createResponse(): InternalResponseInterface
    {
        return new SuccessfulResponse();
    }
}