<?php

namespace InstaParserBundle\Interaction\Dto\Response;

use InstaParserBundle\Interaction\Enum\ResponseType;

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