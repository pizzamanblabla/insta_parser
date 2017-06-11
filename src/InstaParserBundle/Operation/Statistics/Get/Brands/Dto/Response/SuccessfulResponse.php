<?php

namespace InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Response;

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
     * @var Pagination
     */
    private  $pagination;

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
     * @return Pagination
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @param Pagination $pagination
     * @return SuccessfulResponse
     */
    public function setPagination(Pagination $pagination)
    {
        $this->pagination = $pagination;
        return $this;
    }
}