<?php

namespace InstaParserBundle\Command\Mention;

use InstaParserBundle\Command\BaseOperationCommand;
use InstaParserBundle\Entity\Repository\FactoryInterface;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Internal\Service\ServiceInterface;
use InstaParserBundle\Operation\Statistics\Update\Dto\Request\Request;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputInterface;

final class Update extends BaseOperationCommand
{
    const UPDATE_LIMIT = 1000;

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
            ->setName('mention:update')
            ->setDescription('Updating')
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
