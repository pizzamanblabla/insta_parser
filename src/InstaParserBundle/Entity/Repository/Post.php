<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\Query\Expr\Join;
use InstaParserBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * @method findOneByName(string $name)
 * @method findOneByCode(string $code)
 */
final class Post extends EntityRepository
{
    /**
     * @param int $limit
     * @return Entity\Post[]
     */
    public function findAllWithoutData(int $limit)
    {
        $queryBuilder = $this->createQueryBuilder('p');

        $queryBuilder
            ->where('p.location is NULL')
            ->setMaxResults($limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}