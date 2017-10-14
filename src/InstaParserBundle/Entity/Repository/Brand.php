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
            ->select('b AS brand', 'count(DISTINCT s.id) AS subscriberCount', 'sum(case s.isOnPlatform when true then 1 else 0 end) AS subscriberGBCount')
            ->setMaxResults($step)
            ->leftJoin(Entity\Mention::class,'m', Join::WITH, 'm.brand = b.id')
            ->leftJoin('m.subscriber', 's')
            ->groupBy('b.id')
            ->setFirstResult($offset)
            ->orderBy('subscriberCount', 'DESC')
        ;
        return
            array_map(
                function (array $element) {
                    return $element['brand'];
                },
                $queryBuilder->getQuery()->getResult()
            );
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
     * @param int $limit
     * @param int $page
     * @param int $step
     * @return Entity\Brand[]
     */
    public function findTopUntilLimit(int $limit, int $page, int $step)
    {
        $offset = $page * $step - $step;

        $queryBuilder = $this->createQueryBuilder('b');

        $queryBuilder
            ->select('b', 'count(s.id) AS subscriberCount')
            ->leftJoin(Entity\Mention::class,'m', Join::WITH, 'm.brand = b.id')
            ->leftJoin('m.subscriber', 's')
            ->groupBy('b.id')
            ->having('count(s.id) >= :limit')
            ->setParameter('limit', $limit)
            ->setFirstResult($offset)
            ->orderBy('subscriberCount', 'DESC')
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

    /**
     * @param int $limit
     * @return string[]
     */
    public function getCountWithLimit(int $limit)
    {
        $queryBuilder = $this->createQueryBuilder('b');

        $queryBuilder
            ->select('b', 'count(b.id) AS brands')
            ->leftJoin(Entity\Mention::class,'m', Join::WITH, 'm.brand = b.id')
            ->leftJoin('m.subscriber', 's')
            ->groupBy('b.id')
            ->having('count(s.id) >= :limit')
            ->setParameter('limit', $limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}