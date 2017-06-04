<?php

namespace InstaParserBundle\Operation\Statistics\Get\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Dto\Response\Successful;

class SuccessfulResponse implements InternalResponseInterface
{
    use Successful;

    /**
     * @var StatisticElement[]
     */
    private $statistic;

    /**
     * @var TopSubscriber[]
     */
    private $topSubscribers;

    /**
     * @var TopBrand[]
     */
    private $topBrands;

    /**
     * @return StatisticElement[]
     */
    public function getStatistic(): array
    {
        return $this->statistic;
    }

    /**
     * @param StatisticElement[] $statistic
     * @return SuccessfulResponse
     */
    public function setStatistic(array $statistic)
    {
        $this->statistic = $statistic;
        return $this;
    }

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