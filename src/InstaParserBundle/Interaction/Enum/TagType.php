<?php

namespace InstaParserBundle\Interaction\Enum;

class TagType extends Enumeration
{
    const WORLD_CLASS = 'world_class';

    /**
     * @return TagType
     */
    public static function worldClass()
    {
        return new self(static::WORLD_CLASS);
    }

    /**
     * @return bool
     */
    public function isWorldClass()
    {
        return $this->value == static::WORLD_CLASS;
    }
}
