<?php

namespace InstaParserBundle\Interaction\Dto;

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

    /**
     * @param int $current
     * @param int $last
     * @return Pagination
     */
    public function setPaginationList(int $current, int $last)
    {
        $this->list = [];

        for ($i = -2; $i < 3; $i++) {
            $element = $current + $i;

            if ($element > 0 && $element <= $last) {
                $this->list[] = $element;
            }
        }

        return $this;
    }
}