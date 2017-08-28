<?php

namespace InstaParserBundle\Command\Subscriber;

use InstaParserBundle\Command\BaseOperationCommand;
use InstaParserBundle\Entity\Repository\FactoryInterface;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Request\SubscribersRequest;
use InstaParserBundle\Internal\Service\ServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputInterface;

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
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function createRequest(InputInterface $input): InternalRequestInterface
    {
        return
            (new SubscribersRequest())
                ->setSubscribers(
                    $this->repositoryFactory->subscriber()->findAllAWithoutContactInfo(self::UPDATE_LIMIT)
                );
    }
}