<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\EntityManager;
use InstaParserBundle\Entity\Brand as BrandEntity;
use InstaParserBundle\Entity\Mention as MentionEntity;
use InstaParserBundle\Entity\Subscriber as SubscriberEntity;

class Factory implements FactoryInterface
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
        return new Brand($this->entityManager, BrandEntity::class);
    }

    /**
     * {@inheritdoc}
     */
    public function mention(): Mention
    {
        return new Mention($this->entityManager, MentionEntity::class);
    }

    /**
     * {@inheritdoc}
     */
    public function subscriber(): Subscriber
    {
        return new Subscriber($this->entityManager, SubscriberEntity::class);
    }
}