<?php

namespace InstaParserBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="subscriber")
 * @ORM\Entity(repositoryClass="InstaParserBundle\Entity\Repository\Subscriber")
 */
class Subscriber
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="subscriber_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=256, nullable=false)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=16, nullable=false)
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_on_platform", type="boolean")
     */
    private $isOnPlatform;

    /**
     * @var int
     *
     * @ORM\Column(name="subscribers", type="bigint")
     */
    private $subscribers;

    /**
     * @var int
     *
     * @ORM\Column(name="subscriptions", type="bigint")
     */
    private $subscriptions;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128)
     */
    private $email;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
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
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return $this
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Subscriber
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsOnPlatform()
    {
        return $this->isOnPlatform;
    }

    /**
     * @param boolean $isOnPlatform
     * @return $this
     */
    public function setIsOnPlatform($isOnPlatform)
    {
        $this->isOnPlatform = $isOnPlatform;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * @param int $subscribers
     * @return Subscriber
     */
    public function setSubscribers($subscribers)
    {
        $this->subscribers = $subscribers;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

    /**
     * @param int $subscriptions
     * @return $this
     */
    public function setSubscriptions($subscriptions)
    {
        $this->subscriptions = $subscriptions;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return Subscriber
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}