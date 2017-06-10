<?php

namespace InstaParserBundle\Operation\Statistics\Get\Dto\Response;

class Pagination
{
    /**
     * @var int
     */
    private $last;

    /**
     * @var int
     */
    private $current;

    /**
     * @var int[]
     */
    private $list;

    /**
     * @return int
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * @param int $last
     * @return Pagination
     */
    public function setLast($last)
    {
        $this->last = $last;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param int $current
     * @return Pagination
     */
    public function setCurrent($current)
    {
        $this->current = $current;
        return $this;
    }

    /**
     * @return int[]
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param int[] $list
     * @return Pagination
     */
    public function setList(array $list)
    {
        $this->list = $list;
        return $this;
    }
}