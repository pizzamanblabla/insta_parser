<?php

namespace InstaParserBundle\Internal\DataUpdater;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;

interface DataUpdaterInterface
{
    /**
     * @param InternalResponseInterface $response
     * @return void
     */
    public function update(InternalResponseInterface $response);
}