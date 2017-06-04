<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\Query\Expr\Join;
use InstaParserBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * @method findOneByName(string $name)
 */
final class Brand extends EntityRepository
{
    /**
     * @return Entity\Brand[]
     */
    public function findAllWithOrder()
    {
        $queryBuilder = $this->createQueryBuilder('b');

        $queryBuilder->orderBy('b.name', 'ASC');

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param int $limit
     * @return Entity\Brand[]
     */
    public function findTopWithLimit(int $limit)
    {
        $queryBuilder = $this->createQueryBuilder('b');

        $queryBuilder
            ->select('b', 'count(s.id) AS subscriberCount')
            ->leftJoin(Entity\Mention::class,'m', Join::WITH, 'm.brand = b.id')
            ->leftJoin('m.subscriber', 's')
            ->groupBy('b.id')
            ->orderBy('subscriberCount', 'DESC')
            ->setMaxResults($limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}