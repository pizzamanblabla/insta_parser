<?php

namespace InstaParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Post")
 * @ORM\Entity(repositoryClass="InstaParserBundle\Entity\Repository\Post")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="brand_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=128, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=128, nullable=true)
     */
    private $type;

    /**
     * @var Subscriber
     *
     * @ORM\ManyToOne(targetEntity="Subscriber")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subscriber_id", referencedColumnName="id")
     * })
     */
    private $subscriber;

    /**
     * @var Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     * })
     */
    private $location;

    /**
     * @var Hashtag[]
     *
     * @ORM\ManyToMany(targetEntity="Hashtag", orphanRemoval=true)
     * @ORM\JoinTable(
     *     name="post_hashtag",
     *     joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="hashtag_id", referencedColumnName="id")}
     * )
     */
    private $hashtags = [];

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Post
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Post
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Subscriber
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }

    /**
     * @param Subscriber $subscriber
     * @return Post
     */
    public function setSubscriber(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
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

    /**
     * @return Hashtag[]
     */
    public function getHashtags()
    {
        return $this->hashtags;
    }

    /**
     * @param Hashtag[] $hashtags
     * @return Post
     */
    public function setHashtags(array $hashtags)
    {
        $this->hashtags = $hashtags;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Post
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }
}