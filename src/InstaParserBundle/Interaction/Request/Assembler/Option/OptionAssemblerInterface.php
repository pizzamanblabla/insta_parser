<?php

namespace InstaParserBundle\Interaction\Request\Assembler\Option;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

interface OptionAssemblerInterface
{
    /**
     * @param InternalRequestInterface $request
     * @return array
     */
    public function assemble(InternalRequestInterface $request): array;
}