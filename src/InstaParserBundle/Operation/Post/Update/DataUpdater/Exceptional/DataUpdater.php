<?php

namespace InstaParserBundle\Operation\Post\Update\DataUpdater\Exceptional;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Internal\DataUpdater\Exceptional\BaseDataUpdater;
use InstaParserBundle\Operation\Post\Update\Dto\Request\Request;

final class DataUpdater extends BaseDataUpdater
{
    /**
     * @param InternalRequestInterface|Request $request
     * @return void
     */
    public function update(InternalRequestInterface $request)
    {
        $request->getPost()->setType('Failed');
    }
}