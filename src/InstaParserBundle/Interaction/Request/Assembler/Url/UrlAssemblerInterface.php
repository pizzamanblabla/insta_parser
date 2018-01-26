<?php

namespace InstaParserBundle\Interaction\Request\Assembler\Url;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

interface UrlAssemblerInterface
{
    /**
     * @param InternalRequestInterface $request
     * @return string
     */
    public function assemble(InternalRequestInterface $request): string;
}