<?php

namespace InstaParserBundle\Interaction\Request\Assembler\Url;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

final class Predefined implements UrlAssemblerInterface
{
    /**
     * @var string
     */
    private $url;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * {@inheritdoc}
     */
    public function assemble(InternalRequestInterface $request): string
    {
        return $this->url;
    }
}