<?php

namespace InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Dto\Response\Successful;

class SuccessfulResponse implements InternalResponseInterface
{
    use Successful;

    /**
     * @var array
     */
    private $tag;

    /**
     * @return array
     */
    public function getTag(): array
    {
        return $this->tag;
    }

    /**
     * @param array $tag
     * @return SuccessfulResponse
     */
    public function setTag(array $tag): SuccessfulResponse
    {
        $this->tag = $tag;
        return $this;
    }
}