<?php

namespace InstaParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="hashtag")
 * @ORM\Entity(repositoryClass="InstaParserBundle\Entity\Repository\Hashtag")
 */
class Hashtag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="hashtag_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var Post[]
     *
     * @ORM\ManyToMany(targetEntity="Post", orphanRemoval=true)
     * @ORM\JoinTable(
     *     name="post_hashtag",
     *     joinColumns={@ORM\JoinColumn(name="hashtag_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")}
     * )
     */
    private $posts;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Hashtag
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
     * @return Hashtag
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Post[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param Post[] $posts
     * @return Hashtag
     */
    public function setPosts(array $posts)
    {
        $this->posts = $posts;
        return $this;
    }
}