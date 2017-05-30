<?php

namespace InstaParserBundle\Operation\Subscriber\Add\Dto\Request;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

class Request implements InternalRequestInterface
{
    /**
     * @var string[]
     */
    private $names;

    /**
     * @return string[]
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @param string[] $names
     * @return $this
     */
    public function setNames($names)
    {
        $this->names = $names;
        return $this;
    }
}