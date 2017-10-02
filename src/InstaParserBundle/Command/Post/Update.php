<?php

namespace InstaParserBundle\Command\Post;

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
            ->setName('post:update')
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
                    $this->repositoryFactory->post()->findAllWithoutData(self::UPDATE_LIMIT)
                );
    }
}
