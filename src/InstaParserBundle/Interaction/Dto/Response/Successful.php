<?php

namespace InstaParserBundle\Interaction\Dto\Response;

use InstaParserBundle\Internal\Enum\ResponseType;

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