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
     * @param int $page
     * @param int $step
     * @return Entity\Brand[]
     */
    public function findAllWithOrder(int $page, int $step)
    {
        $offset = $page * $step - $step;

        $queryBuilder = $this->createQueryBuilder('b');

        $queryBuilder
            ->setMaxResults($step)
            ->setFirstResult($offset)
            ->orderBy('b.name', 'ASC');

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

    /**
     * @return string[]
     */
    public function getCount()
    {
        $queryBuilder = $this->createQueryBuilder('b');

        $queryBuilder
            ->select('count(b.id) AS brands')
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}