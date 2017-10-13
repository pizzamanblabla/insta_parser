<?php

namespace InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Dto\Response\Successful;

class SuccessfulResponse implements InternalResponseInterface
{
    use Successful;

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
     * @return SuccessfulResponse
     */
    public function setSubscribers(array $subscribers)
    {
        $this->subscribers = $subscribers;
        return $this;
    }
}