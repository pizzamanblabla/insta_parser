<?php

namespace InstaParserBundle\Command\Subscriber;

use InstaParserBundle\Command\BaseUpdateCommand;
use InstaParserBundle\Interaction\Dto\Request\CollectionRequest;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

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
                        ? $this->repositoryFactory->subscriber()->findAllAWithoutContactInfo(self::UPDATE_LIMIT)
                        : $this->repositoryFactory->subscriber()->findAllWithoutDataAndTag(
                        self::UPDATE_LIMIT,
                        $this->repositoryFactory->tag()->findOneByType($input->getOption('tag'))
                    )
                );
    }
}