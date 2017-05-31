<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use InstaParserBundle\Entity;
use InstaParserBundle\Interaction\Enum\UpdateStatus;

/**
 * @method findOneByName(string $name)
 */
final class Subscriber extends EntityRepository
{
    /**
     * @param int $limit
     * @return Entity\Subscriber[]
     */
    public function findAllAvailableWithLimit(int $limit)
    {
        $queryBuilder = $this->createQueryBuilder('s');

        $queryBuilder
            ->where('s.status=:status')
            ->setParameter('status', UpdateStatus::READY)
            ->setMaxResults($limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}