<?php

namespace InstaParserBundle\Interaction\Dto\Response;

use InstaParserBundle\Interaction\Enum\ResponseType;

trait Successful
{
    /**
     * @return ResponseType
     */
    public function getType()
    {
        return ResponseType::successful();
    }
}