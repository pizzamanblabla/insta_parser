<?php

namespace InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Response;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Publication
{
    /**
     * @var string
     *
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    private $caption;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    private $code;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("date")
     */
    private $timestamp;

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     * @return Publication
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Publication
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     * @return Publication
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }
}