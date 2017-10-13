<?php

namespace InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response;

class Subscriber
{
    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $work;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $subscribers;

    /**
     * @var Post[]
     */
    private $hashtagPosts = [];

    /**
     * @var Post[]
     */
    private $locationPosts = [];

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Subscriber
     */
    public function setLink($link)
    {
        $this->link = $link;
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
     * @return Subscriber
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getWork()
    {
        return $this->work;
    }

    /**
     * @param string $work
     * @return Subscriber
     */
    public function setWork($work)
    {
        $this->work = $work;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Subscriber
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * @param string $subscribers
     * @return Subscriber
     */
    public function setSubscribers($subscribers)
    {
        $this->subscribers = $subscribers;
        return $this;
    }

    /**
     * @return Post[]
     */
    public function getHashtagPosts()
    {
        return $this->hashtagPosts;
    }

    /**
     * @param Post[] $hashtagPosts
     * @return Subscriber
     */
    public function setHashtagPosts(array $hashtagPosts)
    {
        $this->hashtagPosts = $hashtagPosts;
        return $this;
    }

    /**
     * @return Post[]
     */
    public function getLocationPosts()
    {
        return $this->locationPosts;
    }

    /**
     * @param Post[] $locationPosts
     * @return Subscriber
     */
    public function setLocationPosts(array $locationPosts)
    {
        $this->locationPosts = $locationPosts;
        return $this;
    }
}