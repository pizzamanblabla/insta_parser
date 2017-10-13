<?php

namespace InstaParserBundle\Operation\Post\Update\Dto\Request;

use InstaParserBundle\Entity\Post;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

class Request implements InternalRequestInterface
{
    /**
     * @var Post
     */
    private $post;

    /**
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post $post
     * @return Request
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
        return $this;
    }
}