<?php

namespace InstaParserBundle\Operation\Statistics\Get\Dto\Response;

use InstaParserBundle\Entity\Brand;

class TopBrand
{
    /**
     * @var Brand
     */
    private $brand;

    /**
     * @var int
     */
    private $subscriberCount;

    /**
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     * @return TopBrand
     */
    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubscriberCount()
    {
        return $this->subscriberCount;
    }

    /**
     * @param int $subscriberCount
     * @return TopBrand
     */
    public function setSubscriberCount($subscriberCount)
    {
        $this->subscriberCount = $subscriberCount;
        return $this;
    }
}