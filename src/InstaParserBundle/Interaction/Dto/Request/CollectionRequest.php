<?php

namespace InstaParserBundle\Interaction\Dto\Request;

class CollectionRequest implements InternalRequestInterface
{
    /**
     * @var mixed[]
     */
    private $collection;

    /**
     * @return mixed[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param mixed[] $collection
     * @return CollectionRequest
     */
    public function setCollection(array $collection)
    {
        $this->collection = $collection;
        return $this;
    }
}