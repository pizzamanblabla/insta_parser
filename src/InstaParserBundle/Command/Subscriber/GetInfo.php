<?php

namespace InstaParserBundle\Command\Subscriber;

use InstaParserBundle\Command\BaseUpdateCommand;
use InstaParserBundle\Interaction\Dto\Request\CollectionRequest;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use Symfony\Component\Console\Input\InputInterface;

final class GetInfo extends BaseUpdateCommand
{
    const UPDATE_LIMIT = 500;

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
            (new CollectionRequest())
                ->setCollection(
                    $this->repositoryFactory->subscriber()->findAllAWithoutContactInfo(self::UPDATE_LIMIT)
                );
    }
}