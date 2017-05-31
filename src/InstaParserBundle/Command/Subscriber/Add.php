<?php

namespace InstaParserBundle\Command\Subscriber;

use InstaParserBundle\Command\BaseOperationCommand;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Operation\Subscriber\Add\Dto\Request\Request;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

final class Add extends BaseOperationCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('subscriber:add')
            ->setDescription('Updating')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of subscriber')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function createRequest(InputInterface $input): InternalRequestInterface
    {
        return (new Request())->setNames([$input->getArgument('name')]);
    }
}