<?php

namespace InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Response;

class BloggersCount
{
    /**
     * @var int
     */
    private $fromPlatform;

    /**
     * @var int
     */
    private $notFromPlatform;

    /**
     * @return int
     */
    public function getFromPlatform()
    {
        return $this->fromPlatform;
    }

    /**
     * @param int $fromPlatform
     * @return BloggersCount
     */
    public function setFromPlatform($fromPlatform)
    {
        $this->fromPlatform = $fromPlatform;
        return $this;
    }

    /**
     * @return int
     */
    public function getNotFromPlatform()
    {
        return $this->notFromPlatform;
    }

    /**
     * @param int $notFromPlatform
     * @return BloggersCount
     */
    public function setNotFromPlatform($notFromPlatform)
    {
        $this->notFromPlatform = $notFromPlatform;
        return $this;
    }
}