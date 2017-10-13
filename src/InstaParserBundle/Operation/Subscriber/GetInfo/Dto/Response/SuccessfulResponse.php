<?php

namespace InstaParserBundle\Operation\Subscriber\GetInfo\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Dto\Response\Successful;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class SuccessfulResponse implements InternalResponseInterface
{
    use Successful;

    /**
     * @var Quantity
     *
     * @Assert\Valid()
     *
     * @Serializer\Type("InstaParserBundle\Operation\Subscriber\GetInfo\Dto\Response\Quantity")
     * @Serializer\SerializedName("followed_by")
     */
    private $subscriberCount;

    /**
     * @var Quantity
     *
     * @Assert\Valid()
     *
     * @Serializer\Type("InstaParserBundle\Operation\Subscriber\GetInfo\Dto\Response\Quantity")
     * @Serializer\SerializedName("follows")
     */
    private $subscriptionCount;

    /**
     * @var string
     *
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("biography")
     */
    private $description;

    /**
     * @return Quantity
     */
    public function getSubscriberCount()
    {
        return $this->subscriberCount;
    }

    /**
     * @param Quantity $subscriberCount
     * @return SuccessfulResponse
     */
    public function setSubscriberCount($subscriberCount)
    {
        $this->subscriberCount = $subscriberCount;
        return $this;
    }

    /**
     * @return Quantity
     */
    public function getSubscriptionCount()
    {
        return $this->subscriptionCount;
    }

    /**
     * @param Quantity $subscriptionCount
     * @return SuccessfulResponse
     */
    public function setSubscriptionCount($subscriptionCount)
    {
        $this->subscriptionCount = $subscriptionCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return SuccessfulResponse
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}