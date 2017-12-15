<?php

namespace InstaParserBundle\Operation\Subscriber\Common\Request\Assembler\Url;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Request\SubscriberRequest;
use InstaParserBundle\Interaction\Request\Assembler\Url\UrlAssemblerInterface;

final class Assembler implements UrlAssemblerInterface
{
    /**
     * @param InternalRequestInterface|SubscriberRequest $request
     * @return string
     */
    public function assemble(InternalRequestInterface $request): string
    {
        return $request->getSubscriber()->getLink() . '/';
    }
}