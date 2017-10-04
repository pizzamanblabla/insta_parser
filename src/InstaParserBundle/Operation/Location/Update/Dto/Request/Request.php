<?php

namespace InstaParserBundle\Operation\Location\Update\Dto\Request;

use InstaParserBundle\Entity\Location;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

class Request implements InternalRequestInterface
{
    /**
     * @var Location
     */
    private $location;

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Location $location
     * @return Request
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
        return $this;
    }
}