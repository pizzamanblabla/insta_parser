<?php

namespace InstaParserBundle\Command\Mention;

use InstaParserBundle\Command\BaseUpdateCommand;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Operation\Statistics\Update\Collection\Dto\Request\Request;
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
