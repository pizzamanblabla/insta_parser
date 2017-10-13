<?php

namespace InstaParserBundle\Operation\Subscriber\GetInfo\Dto\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Quantity
{
    /**
     * @var string
     *
     * @Assert\Type("integer")
     *
     * @Serializer\Type("integer")
     */
    private $count;

    /**
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param string $count
     * @return Quantity
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }
}