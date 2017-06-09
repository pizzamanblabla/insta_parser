<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
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
            ->orderBy('s.updatedAt', 'ASC')
            ->setMaxResults($limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param int $limit
     * @return Entity\Subscriber[]
     */
    public function findTopWithLimit(int $limit)
    {
        $queryBuilder = $this->createQueryBuilder('s');

        $queryBuilder
            ->select('s', 'count(b.id) AS brandCount')
            ->leftJoin(Entity\Mention::class,'m', Join::WITH, 'm.subscriber = s.id')
            ->leftJoin('m.brand', 'b')
            ->groupBy('s.id')
            ->orderBy('brandCount', 'DESC')
            ->setMaxResults($limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}