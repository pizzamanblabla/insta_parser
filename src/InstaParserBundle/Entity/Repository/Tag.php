<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\Query\Expr\Join;
use InstaParserBundle\Entity;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

/**
 * @method findOneByType(string $type)
 */
final class Tag extends EntityRepository
{
    /**
     * @return array
     */
    public function findOneByTypeAsArray(string $type)
    {
        $queryBuilder = $this->createQueryBuilder('tag');

        $queryBuilder
            ->where('tag.type=:type')
            ->setParameter('type', $type)
        ;

        return $queryBuilder->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }
}