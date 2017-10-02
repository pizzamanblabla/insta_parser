<?php

namespace InstaParserBundle\Command;

use InstaParserBundle\Entity\Repository\FactoryInterface;
use InstaParserBundle\Internal\Service\ServiceInterface;
use Psr\Log\LoggerInterface;

abstract class BaseUpdateCommand extends BaseOperationCommand
{
    /**
     * @var FactoryInterface
     */
    protected $repositoryFactory;

    /**
     * @param ServiceInterface $service
     * @param FactoryInterface $repositoryFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ServiceInterface $service,
        FactoryInterface $repositoryFactory,
        LoggerInterface $logger
    ) {
        parent::__construct($service, $logger);

        $this->repositoryFactory = $repositoryFactory;
    }
}
