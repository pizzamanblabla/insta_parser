<?php

namespace InstaParserBundle\Internal\Enum;

class UpdateStatus extends Enumeration
{
    const READY = 'ready';

    const IN_PROGRESS = 'in_progress';

    /**
     * @return UpdateStatus
     */
    public static function ready()
    {
        return new self(static::READY);
    }

    /**
     * @return UpdateStatus
     */
    public static function inProgress()
    {
        return new self(static::IN_PROGRESS);
    }

    /**
     * @return bool
     */
    public function isReady()
    {
        return $this->value == static::READY;
    }

    /**
     * @return bool
     */
    public function isInProgress()
    {
        return $this->value == static::IN_PROGRESS;
    }
}
