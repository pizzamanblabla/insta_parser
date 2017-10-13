<?php

namespace InstaParserBundle\Interaction\Dto\Request;

use InstaParserBundle\Entity\Subscriber;

class SubscribersRequest implements InternalRequestInterface
{
    /**
     * @var Subscriber[]
     */
    private $subscribers = [];

    /**
     * @return Subscriber[]
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * @param Subscriber[] $subscribers
     * @return $this
     */
    public function setSubscribers(array $subscribers)
    {
        $this->subscribers = $subscribers;
        return $this;
    }
}