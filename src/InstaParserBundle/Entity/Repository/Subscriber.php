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
    public function findAllAWithoutContactInfo(int $limit)
    {
        $queryBuilder = $this->createQueryBuilder('s');

        $queryBuilder
            ->where('s.status=:status')
            ->setParameter('status', UpdateStatus::READY)
            ->andWhere('s.email is NULL')
            ->andWhere('s.subscribers is NULL')
            ->andWhere('s.subscriptions is NULL')
            ->orderBy('s.updatedAt', 'ASC')
            ->setMaxResults($limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param int $limit
     * @param Entity\Tag $tag
     * @return Entity\Post[]
     */
    public function findAllWithoutDataAndTag(int $limit, Entity\Tag $tag)
    {
        $queryBuilder = $this->createQueryBuilder('s');

        $queryBuilder
            ->join('s.tags', 't')
            ->where('s.status=:status')
            ->setParameter('status', UpdateStatus::READY)
            ->andWhere('s.email is NULL')
            ->andWhere('s.subscribers is NULL')
            ->andWhere('s.subscriptions is NULL')
            ->andWhere($queryBuilder->expr()->eq('t.id', $tag->getId()))
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

    /**
     * @param int $limit
     * @param int $page
     * @param int $limit
     * @return Entity\Subscriber[]
     */
    public function findTopUntilLimit(int $limit, int $page, int $step)
    {
        $offset = $page * $step - $step;

        $queryBuilder = $this->createQueryBuilder('s');

        $queryBuilder
            ->select('s', 'count(b.id) AS brandCount')
            ->leftJoin(Entity\Mention::class,'m', Join::WITH, 'm.subscriber = s.id')
            ->leftJoin('m.brand', 'b')
            ->groupBy('s.id')
            ->having('count(b.id) >= :limit')
            ->setParameter('limit', $limit)
            ->setFirstResult($offset)
            ->orderBy('brandCount', 'DESC')
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param int $limit
     * @return string[]
     */
    public function getCountWithLimit(int $limit)
    {
        $queryBuilder = $this->createQueryBuilder('s');

        $queryBuilder
            ->select('s', 'count(s.id) AS subscribers')
            ->leftJoin(Entity\Mention::class,'m', Join::WITH, 'm.subscriber = s.id')
            ->leftJoin('m.brand', 'b')
            ->groupBy('s.id')
            ->having('count(b.id) >= :limit')
            ->setParameter('limit', $limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}