<?php

namespace InstaParserBundle\Internal\DataUpdater\Exceptional;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

final class Blank implements ExceptionalDataUpdaterInterface
{
    /**
     * {@inheritdoc}
     */
    public function update(InternalRequestInterface $request)
    {
        /*_*/
    }
}