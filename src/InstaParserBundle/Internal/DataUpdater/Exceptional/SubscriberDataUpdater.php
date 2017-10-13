<?php

namespace InstaParserBundle\Internal\DataUpdater\Exceptional;;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Enum\UpdateStatus;
use InstaParserBundle\Interaction\Dto\Request\SubscriberRequest;

final class SubscriberDataUpdater extends BaseDataUpdater
{
    /**
     * @param InternalRequestInterface|SubscriberRequest $request
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