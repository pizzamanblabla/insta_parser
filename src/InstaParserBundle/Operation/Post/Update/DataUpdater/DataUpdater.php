<?php

namespace InstaParserBundle\Operation\Post\Update\DataUpdater;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\DataUpdater\DataUpdaterInterface;
use InstaParserBundle\Operation\Post\Update\Dto\Request;

final class DataUpdater implements DataUpdaterInterface
{
    /**
     * @param InternalRequestInterface|Request $request
     * @param InternalResponseInterface $response
     * @return void
     */
    public function update(InternalRequestInterface $request, InternalResponseInterface $response)
    {
        // TODO: Implement update() method.
    }
}