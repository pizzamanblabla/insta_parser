<?php

namespace InstaParserBundle\Operation\Subscriber\GetInfo\DataUpdater;

use DateTime;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Request\SubscriberRequest;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Enum\UpdateStatus;
use InstaParserBundle\Internal\DataUpdater\BaseDataUpdater;
use InstaParserBundle\Operation\Subscriber\GetInfo\Dto\Response\SuccessfulResponse;

final class DataUpdater extends BaseDataUpdater
{
    /**
     * @param InternalRequestInterface|SubscriberRequest $request
     * @param InternalResponseInterface|SuccessfulResponse $response
     * @return void
     */
    public function update(InternalRequestInterface $request, InternalResponseInterface $response)
    {
        if (!$response->getType()->isSuccessful() || is_null($response->getSubscriberCount())) {
            $request->getSubscriber()->setStatus(UpdateStatus::FAILED);
        } else {
            $request->getSubscriber()
                ->setStatus(UpdateStatus::READY)
                ->setUpdatedAt(new DateTime())
                ->setSubscribers($response->getSubscriberCount()->getCount())
                ->setSubscriptions($response->getSubscriptionCount()->getCount())
            ;

            if (!is_null($response->getDescription())) {
                $request->getSubscriber()->setEmail($this->parseEmails($response->getDescription()));
            }
        }
    }

    /**
     * @param string $description
     * @return string
     */
    private function parseEmails(string $description): string
    {
        preg_match('/(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))/iD', $description, $match);

        return count($match) ? implode('\n', $match) : '';
    }
}