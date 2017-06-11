<?php

namespace InstaParserBundle\Operation\Statistics\Get\Top\Dto\Response;

use InstaParserBundle\Entity\Subscriber;

class TopSubscriber
{
    /**
     * @var Subscriber
     */
    private $subscriber;

    /**
     * @var int
     */
    private $brandCount;

    /**
     * @return Subscriber
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }

    /**
     * @param Subscriber $subscriber
     * @return TopSubscriber
     */
    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;
        return $this;
    }

    /**
     * @return int
     */
    public function getBrandCount()
    {
        return $this->brandCount;
    }

    /**
     * @param int $brandCount
     * @return TopSubscriber
     */
    public function setBrandCount($brandCount)
    {
        $this->brandCount = $brandCount;
        return $this;
    }
}