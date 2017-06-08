<?php

namespace InstaParserBundle\Operation\Statistics\Get\Dto\Request;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

class Request implements InternalRequestInterface
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $step;

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return Request
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param int $step
     * @return Request
     */
    public function setStep($step)
    {
        $this->step = $step;
        return $this;
    }
}