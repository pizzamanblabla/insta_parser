<?php

namespace InstaParserBundle\PayloadModifier;

interface PayloadModifierInterface
{
    /**
     * @param string $modifiable
     * @return mixed[]
     */
    public function modify(string $modifiable): array;
}