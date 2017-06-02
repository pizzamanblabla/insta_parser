<?php

namespace InstaParserBundle\Interaction\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;

interface ResponseFactoryInterface
{
    /**
     * @return InternalResponseInterface
     */
    public function createResponse(): InternalResponseInterface;
}