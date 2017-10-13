<?php

namespace InstaParserBundle\Interaction\Dto\Request;

use InstaParserBundle\Entity\Subscriber;

class SubscriberRequest implements InternalRequestInterface
{
    /**
     * @var Subscriber
     */
    private $subscriber;

    /**
     * @return Subscriber
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }

    /**
     * @param Subscriber $subscriber
     * @return $this
     */
    public function setSubscriber(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
        return $this;
    }
}