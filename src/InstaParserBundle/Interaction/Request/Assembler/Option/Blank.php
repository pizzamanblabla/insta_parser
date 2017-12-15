<?php

namespace InstaParserBundle\Interaction\Request\Assembler\Option;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

final class Blank implements OptionAssemblerInterface
{
    /**
     * {@inheritdoc}
     */
    public function assemble(InternalRequestInterface $request): array
    {
        return [];
    }
}