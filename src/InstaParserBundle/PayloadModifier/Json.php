<?php

namespace InstaParserBundle\PayloadModifier;

final class Json implements PayloadModifierInterface
{
    /**
     * {@inheritdoc}
     */
    public function modify(string $modifiable): array
    {
        $modified =  json_decode($modifiable, 1);

        return is_array($modified) ? $modified : [];
    }
}