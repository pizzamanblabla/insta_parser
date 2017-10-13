<?php

namespace InstaParserBundle\Operation\Location\Update\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Response\ResponseFactoryInterface;

final class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createResponse(): InternalResponseInterface
    {
        return new Response();
    }
}