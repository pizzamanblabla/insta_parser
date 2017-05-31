<?php

namespace InstaParserBundle\Command\Mention;

use InstaParserBundle\Command\BaseOperationCommand;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

final class Parse extends BaseOperationCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('parser:parse')
            ->setDescription('Updating')
            ->addArgument('key', InputArgument::REQUIRED, 'Which subscriber needs to be updated?')
            ->addOption('subscriber', 's', InputOption::VALUE_NONE)
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function createRequest(InputInterface $input): InternalRequestInterface
    {
        // TODO: Implement createRequest() method.
    }
}
