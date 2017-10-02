<?php

namespace InstaParserBundle\Entity\Repository;

use Doctrine\ORM\Query\Expr\Join;
use InstaParserBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * @method findOneByName(string $name)
 */
final class Hashtag extends EntityRepository
{

}