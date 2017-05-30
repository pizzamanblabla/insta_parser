<?php

namespace InstaParserBundle\Interaction\Dto\Response;

use InstaParserBundle\Internal\Enum\ResponseType;

interface InternalResponseInterface
{
    /**
     * @return ResponseType
     */
    public function getType();
}