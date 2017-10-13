<?php

namespace InstaParserBundle\Operation\Post\Update\DataUpdater\Exceptional;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Internal\DataUpdater\Exceptional\BaseDataUpdater;
use InstaParserBundle\Operation\Post\Update\Dto\Request\Request;

final class DataUpdater extends BaseDataUpdater
{
    /**
     * @param InternalRequestInterface|Request $request
     * @param string $errorMessage
     * @return void
     */
    public function update(InternalRequestInterface $request, string $errorMessage)
    {
        if (!preg_match('/Client error.+429/ui', $errorMessage)) {
            $request->getPost()->setType('Failed');
        }
    }
}