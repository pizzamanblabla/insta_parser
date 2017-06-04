<?php

namespace InstaParserBundle\Operation\Statistics\Update\Collection\Dto\Request;

use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

class Request implements InternalRequestInterface
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
     * @return Request
     */
    public function setSubscribers(array $subscribers)
    {
        $this->subscribers = $subscribers;
        return $this;
    }
}