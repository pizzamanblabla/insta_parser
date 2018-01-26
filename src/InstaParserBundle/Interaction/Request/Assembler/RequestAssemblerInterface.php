<?php

namespace InstaParserBundle\Interaction\Request\Assembler;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use Psr\Http\Message\RequestInterface;

interface RequestAssemblerInterface
{
    /**
     * @param InternalRequestInterface $request
     * @return RequestInterface
     */
    public function assemble(InternalRequestInterface $request): RequestInterface;
}