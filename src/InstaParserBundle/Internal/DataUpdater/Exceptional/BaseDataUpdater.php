<?php

namespace InstaParserBundle\Internal\DataUpdater\Exceptional;

use InstaParserBundle\Entity\Repository\FactoryInterface as RepositoryFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

abstract class BaseDataUpdater implements ExceptionalDataUpdaterInterface
{
    use LoggerAwareTrait;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var RepositoryFactoryInterface
     */
    protected $repositoryFactory;

    /**
     * @param EntityManagerInterface $entityManager
     * @param RepositoryFactoryInterface $repositoryFactory
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        RepositoryFactoryInterface $repositoryFactory,
        LoggerInterface $logger
    ) {
        $this->setLogger($logger);

        $this->entityManager = $entityManager;
        $this->repositoryFactory = $repositoryFactory;
    }
}