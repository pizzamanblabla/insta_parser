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
     * @var bool
     */
    private $onPlatform = false;

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

    /**
     * @return boolean
     */
    public function isOnPlatform()
    {
        return $this->onPlatform;
    }

    /**
     * @param boolean $onPlatform
     * @return Request
     */
    public function setOnPlatform($onPlatform)
    {
        $this->onPlatform = $onPlatform;
        return $this;
    }
}