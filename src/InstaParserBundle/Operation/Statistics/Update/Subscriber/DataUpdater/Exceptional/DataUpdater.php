<?php

namespace InstaParserBundle\Operation\Statistics\Update\Subscriber\DataUpdater\Exceptional;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Enum\UpdateStatus;
use InstaParserBundle\Internal\DataUpdater\Exceptional\BaseDataUpdater;
use InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Request\Request;

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
            $request->getSubscriber()->setStatus(UpdateStatus::FAILED);
        } else {
            $request->getSubscriber()->setStatus(UpdateStatus::READY);
        }
    }
}