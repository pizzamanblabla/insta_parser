<?php

namespace InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response;

class Location
{
    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $long;

    /**
     * @var string
     */
    private $name;

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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Location
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}