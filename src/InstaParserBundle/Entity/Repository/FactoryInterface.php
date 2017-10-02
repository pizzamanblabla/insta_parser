<?php

namespace InstaParserBundle\Entity\Repository;

interface FactoryInterface
{
    /**
     * @return Brand
     */
    public function brand(): Brand;

    /**
     * @return Mention
     */
    public function mention(): Mention;

    /**
     * @return Subscriber
     */
    public function subscriber(): Subscriber;

    /**
     * @return Hashtag
     */
    public function hashtag(): Hashtag;

    /**
     * @return Location
     */
    public function location(): Location;

    /**
     * @return Post
     */
    public function Post(): Post;
}