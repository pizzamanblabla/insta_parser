<?php

namespace InstaParserBundle\Command\Post;

use InstaParserBundle\Command\BaseUpdateCommand;
use InstaParserBundle\Interaction\Dto\Request\CollectionRequest;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

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
            ->addOption(
                'tag',
                '-t',
                InputOption::VALUE_OPTIONAL,
                'Who do you want to update?',
                ''
            )
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
                    empty($input->getOption('tag'))
                        ? $this->repositoryFactory->post()->findAllWithoutData(self::UPDATE_LIMIT)
                        : $this->repositoryFactory->post()->findAllWithoutDataAndTag(
                            self::UPDATE_LIMIT,
                            $this->repositoryFactory->tag()->findOneByType($input->getOption('tag'))
                        )
                );
    }
}
