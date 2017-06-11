<?php

namespace InstaParserBundle\Operation\Statistics\Get\Top\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Dto\Response\Successful;

class SuccessfulResponse implements InternalResponseInterface
{
    use Successful;

    /**
     * @var TopSubscriber[]
     */
    private $topSubscribers;

    /**
     * @var TopBrand[]
     */
    private $topBrands;

    /**
     * @return TopSubscriber[]
     */
    public function getTopSubscribers()
    {
        return $this->topSubscribers;
    }

    /**
     * @param TopSubscriber[] $topSubscribers
     * @return SuccessfulResponse
     */
    public function setTopSubscribers(array $topSubscribers)
    {
        $this->topSubscribers = $topSubscribers;
        return $this;
    }

    /**
     * @return TopBrand[]
     */
    public function getTopBrands()
    {
        return $this->topBrands;
    }

    /**
     * @param TopBrand[] $topBrands
     * @return SuccessfulResponse
     */
    public function setTopBrands(array $topBrands)
    {
        $this->topBrands = $topBrands;
        return $this;
    }
}