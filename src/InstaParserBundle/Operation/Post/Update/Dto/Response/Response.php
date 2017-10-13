<?php

namespace InstaParserBundle\Operation\Post\Update\Dto\Response;

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
     *
     * @Serializer\Type("InstaParserBundle\Operation\Post\Update\Dto\Response\Location")
     */
    private $location;

    /**
     * @var string
     *
     * @Assert\Type("string")
     * @Assert\NotNull()
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("__typename")
     */
    private $typeName;

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

    /**
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * @param string $typeName
     * @return Response
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }
}