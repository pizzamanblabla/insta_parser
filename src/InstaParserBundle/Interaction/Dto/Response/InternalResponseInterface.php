<?php

namespace InstaParserBundle\Interaction\Dto\Response;

use InstaParserBundle\Interaction\Enum\ResponseType;

interface InternalResponseInterface
{
    /**
     * @return ResponseType
     */
    public function getType();
}