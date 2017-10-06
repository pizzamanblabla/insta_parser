<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\EntityManager;
use InstaParserBundle\Entity\Brand as BrandEntity;
use InstaParserBundle\Entity\Mention as MentionEntity;
use InstaParserBundle\Entity\Subscriber as SubscriberEntity;
use InstaParserBundle\Entity;

final class Factory implements FactoryInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function brand(): Brand
    {
        return $this->entityManager->getRepository(BrandEntity::class);
    }

    /**
     * {@inheritdoc}
     */
    public function mention(): Mention
    {
        return $this->entityManager->getRepository(MentionEntity::class);
    }

    /**
     * {@inheritdoc}
     */
    public function subscriber(): Subscriber
    {
        return $this->entityManager->getRepository(SubscriberEntity::class);
    }

    /**
     * @return Hashtag
     */
    public function hashtag(): Hashtag
    {
        return $this->entityManager->getRepository(Entity\Hashtag::class);
    }

    /**
     * @return Location
     */
    public function location(): Location
    {
        return $this->entityManager->getRepository(Entity\Location::class);
    }

    /**
     * @return Post
     */
    public function post(): Post
    {
        return $this->entityManager->getRepository(Entity\Post::class);
    }
}