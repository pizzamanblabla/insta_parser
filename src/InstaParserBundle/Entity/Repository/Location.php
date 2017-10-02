<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\Query\Expr\Join;
use InstaParserBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * @method findOneByName(string $name)
 */
final class Location extends EntityRepository
{
    /**
     * @param int $limit
     * @return Entity\Location[]
     */
    public function findAllWithoutData(int $limit)
    {
        $queryBuilder = $this->createQueryBuilder('l');

        $queryBuilder
            ->where('l.lat is NULL')
            ->setMaxResults($limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}