<?php

namespace InstaParserBundle\Operation\Post\Update\Service;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Operation\Post\Update\Dto\Request;

final class Service extends BaseEntityService
{
    /**
     * @param InternalRequestInterface|Request $request
     * @return InternalResponseInterface
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        // TODO: Implement behave() method.
    }
}