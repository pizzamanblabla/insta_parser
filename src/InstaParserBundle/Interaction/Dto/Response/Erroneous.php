<?php

namespace InstaParserBundle\Interaction\Dto\Response;

use InstaParserBundle\Internal\Enum\ResponseType;

trait Erroneous
{
    /**
     * @return ResponseType
     */
    public function getType()
    {
        return ResponseType::erroneous();
    }
}