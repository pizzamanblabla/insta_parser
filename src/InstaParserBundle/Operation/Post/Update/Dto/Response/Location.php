<?php

namespace InstaParserBundle\Operation\Post\Update\Dto\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Location
{
    /**
     * @var string
     *
     * @Assert\Type("string")
     * @Assert\NotNull()
     *
     * @Serializer\Type("string")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\Type("string")
     * @Assert\NotNull()
     *
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Location
     */
    public function setId($id)
    {
        $this->id = $id;
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