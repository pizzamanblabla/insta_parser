<?php

namespace InstaParserBundle\Command\Location;

use InstaParserBundle\Command\BaseUpdateCommand;
use InstaParserBundle\Interaction\Dto\Request\CollectionRequest;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use Symfony\Component\Console\Input\InputInterface;

final class Update extends BaseUpdateCommand
{
    const UPDATE_LIMIT = 500;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('location:update')
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
                    $this->repositoryFactory->location()->findAllWithoutData(self::UPDATE_LIMIT)
                );
    }
}
