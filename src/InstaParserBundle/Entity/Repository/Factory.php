<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\EntityManager;
use InstaParserBundle\Entity\Brand as BrandEntity;
use InstaParserBundle\Entity\Mention as MentionEntity;
use InstaParserBundle\Entity\Subscriber as SubscriberEntity;

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
}