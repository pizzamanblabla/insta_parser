<?php

namespace InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response;

class Post
{
    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $hashtag;

    /**
     * @var Location
     */
    private $location;

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Post
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getHashtag()
    {
        return $this->hashtag;
    }

    /**
     * @param string $hashtag
     * @return Post
     */
    public function setHashtag($hashtag)
    {
        $this->hashtag = $hashtag;
        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Location $location
     * @return Post
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
        return $this;
    }
}