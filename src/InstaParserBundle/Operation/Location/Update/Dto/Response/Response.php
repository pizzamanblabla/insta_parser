<?php

namespace InstaParserBundle\Operation\Location\Update\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Dto\Response\Successful;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Response implements InternalResponseInterface
{
    use Successful;

    /**
     * @var Location
     *
     * @Assert\Valid()
     * @Assert\NotNull()
     *
     * @Serializer\Type("InstaParserBundle\Operation\Location\Update\Dto\Response\Location")
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
     * @return Response
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
        return $this;
    }
}