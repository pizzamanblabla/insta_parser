<?php

namespace InstaParserBundle\Command\Subscriber;

use InstaParserBundle\Command\BaseOperationCommand;
use InstaParserBundle\Entity\Repository\FactoryInterface;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Internal\Service\ServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

final class GetInfo extends BaseOperationCommand
{
    const UPDATE_LIMIT = 500;

    /**
     * @var FactoryInterface
     */
    private $repositoryFactory;

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

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('subscriber:get_info')
            ->setDescription('Updating')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of subscriber')
            ->addOption('platform', 'p', InputOption::VALUE_NONE)
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function createRequest(InputInterface $input): InternalRequestInterface
    {
        return
            (new Request())
                ->setSubscribers(
                    $this->repositoryFactory->subscriber()->findAllAvailableWithLimit(self::UPDATE_LIMIT)
                );
    }
}