<?php

namespace InstaParserBundle\Entity\Repository;

use DateTime;
use Doctrine\ORM\EntityRepository;
use InstaParserBundle\Entity;

final class Mention extends EntityRepository
{
    /**
     * @param DateTime $date
     * @param Entity\Brand $brand
     * @param Entity\Subscriber $subscriber
     * @return Entity\Mention
     */
    public function findOneByDateAndBrandAndSubscriber(
        DateTime $date,
        Entity\Brand $brand,
        Entity\Subscriber $subscriber
    ) {
        $queryBuilder = $this->createQueryBuilder('m');

        $queryBuilder
            ->where('m.subscriber=:subscriber')
            ->andWhere('m.brand=:brand')
            ->andWhere('m.date=:date')
            ->setParameter('subscriber', $subscriber)
            ->setParameter('brand', $brand)
            ->setParameter('date', $date)
            ->setMaxResults(1)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}