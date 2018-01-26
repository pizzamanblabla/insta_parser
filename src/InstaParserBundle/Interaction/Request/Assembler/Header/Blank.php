<?php

namespace InstaParserBundle\Interaction\Request\Assembler\Header;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

final class Blank implements HeaderAssemblerInterface
{
    /**
     * {@inheritdoc}
     */
    public function assemble(InternalRequestInterface $request): array
    {
        return [];
    }
}