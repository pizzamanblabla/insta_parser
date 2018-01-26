<?php

namespace InstaParserBundle\Operation\Parsing\Download\Dto\Request;

use InstaParserBundle\Entity\Tag;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

class Request implements InternalRequestInterface
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * @return Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param Tag $tag
     * @return Request
     */
    public function setTag(Tag $tag)
    {
        $this->tag = $tag;
        return $this;
    }
}