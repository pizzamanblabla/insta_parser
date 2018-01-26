<?php

namespace InstaParserBundle\Interaction\Request\Assembler\Header;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

interface HeaderAssemblerInterface
{
    /**
     * @param InternalRequestInterface $request
     * @return array
     */
    public function assemble(InternalRequestInterface $request): array;
}