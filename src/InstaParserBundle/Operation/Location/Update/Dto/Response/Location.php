<?php

namespace InstaParserBundle\Operation\Location\Update\Dto\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Location
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    private $lat;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("lng")
     */
    private $long;

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     * @return Location
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return string
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @param string $long
     * @return Location
     */
    public function setLong($long)
    {
        $this->long = $long;
        return $this;
    }
}