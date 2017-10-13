<?php

namespace InstaParserBundle\Interaction\RequestAssembler;

abstract class BaseAssembler implements RequestAssemblerInterface
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $method;

    /**
     * @param string $baseUrl
     * @param string $method
     */
    public function __construct(string $baseUrl, string $method)
    {
        $this->baseUrl = $baseUrl;
        $this->method = $method;
    }
}