<?php

namespace InstaParserBundle\Operation\Location\Update\DataUpdater;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\DataUpdater\DataUpdaterInterface;
use InstaParserBundle\Operation\Location\Update\Dto\Request\Request;
use InstaParserBundle\Operation\Location\Update\Dto\Response\Response;

final class DataUpdater implements DataUpdaterInterface
{
    /**
     * @param InternalRequestInterface|Request $request
     * @param InternalResponseInterface|Response $response
     * @return void
     */
    public function update(InternalRequestInterface $request, InternalResponseInterface $response)
    {
        $request->getLocation()
            ->setLat($response->getLocation()->getLat())
            ->setLong($response->getLocation()->getLong())
        ;
    }
}