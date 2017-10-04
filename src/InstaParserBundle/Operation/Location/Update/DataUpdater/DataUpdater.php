<?php

namespace InstaParserBundle\Operation\Location\Update\DataUpdater;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\DataUpdater\DataUpdaterInterface;
use InstaParserBundle\Operation\Location\Update\Dto\Request;

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