<?php

namespace InstaParserBundle\Interaction\Dto\Request;

class PaginationRequest implements InternalRequestInterface
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
     * @return PaginationRequest
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
     * @return PaginationRequest
     */
    public function setStep($step)
    {
        $this->step = $step;
        return $this;
    }
}