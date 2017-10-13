<?php

namespace InstaParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="InstaParserBundle\Entity\Repository\Tag")
 */
class Tag
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
     * @ORM\Column(name="type", type="string", length=128, nullable=false)
     */
    private $type;

    /**
     * @var Subscriber[]
     *
     * @ORM\ManyToMany(targetEntity="Subscriber", orphanRemoval=true)
     * @ORM\JoinTable(
     *     name="subscriber_tag",
     *     joinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="subscriber_id", referencedColumnName="id")}
     * )
     */
    private $subscribers = [];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Tag
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Subscriber[]
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * @param Subscriber[] $subscribers
     * @return Tag
     */
    public function setSubscribers($subscribers)
    {
        $this->subscribers = $subscribers;
        return $this;
    }
}