<?php

namespace InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Response;

use InstaParserBundle\Entity\Brand;
use InstaParserBundle\Entity\Subscriber;

class StatisticElement
{
    /**
     * @var Brand
     */
    private $brand;

    /**
     * @var Subscriber[]
     */
    private $todaySubscribers;

    /**
     * @var Subscriber[]
     */
    private $weekSubscribers;

    /**
     * @var Subscriber[]
     */
    private $monthSubscribers;

    /**
     * @var BloggersCount
     */
    private $todayBloggerCount;

    /**
     * @var BloggersCount
     */
    private $weekBloggerCount;

    /**
     * @var BloggersCount
     */
    private $monthBloggerCount;

    /**
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     * @return StatisticElement
     */
    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return Subscriber[]
     */
    public function getTodaySubscribers()
    {
        return $this->todaySubscribers;
    }

    /**
     * @param Subscriber[] $todaySubscribers
     * @return StatisticElement
     */
    public function setTodaySubscribers(array $todaySubscribers)
    {
        $this->todaySubscribers = $todaySubscribers;
        return $this;
    }

    /**
     * @return Subscriber[]
     */
    public function getWeekSubscribers()
    {
        return $this->weekSubscribers;
    }

    /**
     * @param Subscriber[] $weekSubscribers
     * @return StatisticElement
     */
    public function setWeekSubscribers(array $weekSubscribers)
    {
        $this->weekSubscribers = $weekSubscribers;
        return $this;
    }

    /**
     * @return Subscriber[]
     */
    public function getMonthSubscribers()
    {
        return $this->monthSubscribers;
    }

    /**
     * @param Subscriber[] $monthSubscribers
     * @return StatisticElement
     */
    public function setMonthSubscribers(array $monthSubscribers)
    {
        $this->monthSubscribers = $monthSubscribers;
        return $this;
    }

    /**
     * @return BloggersCount
     */
    public function getTodayBloggerCount()
    {
        return $this->todayBloggerCount;
    }

    /**
     * @param BloggersCount $todayBloggerCount
     * @return StatisticElement
     */
    public function setTodayBloggerCount(BloggersCount $todayBloggerCount)
    {
        $this->todayBloggerCount = $todayBloggerCount;
        return $this;
    }

    /**
     * @return BloggersCount
     */
    public function getWeekBloggerCount()
    {
        return $this->weekBloggerCount;
    }

    /**
     * @param BloggersCount $weekBloggerCount
     * @return StatisticElement
     */
    public function setWeekBloggerCount(BloggersCount $weekBloggerCount)
    {
        $this->weekBloggerCount = $weekBloggerCount;
        return $this;
    }

    /**
     * @return BloggersCount
     */
    public function getMonthBloggerCount()
    {
        return $this->monthBloggerCount;
    }

    /**
     * @param BloggersCount $monthBloggerCount
     * @return StatisticElement
     */
    public function setMonthBloggerCount(BloggersCount $monthBloggerCount)
    {
        $this->monthBloggerCount = $monthBloggerCount;
        return $this;
    }
}