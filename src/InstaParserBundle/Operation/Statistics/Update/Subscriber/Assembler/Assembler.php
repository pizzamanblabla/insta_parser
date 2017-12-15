<?php

namespace InstaParserBundle\Operation\Statistics\Update\Subscriber\Assembler;

use GuzzleHttp\Psr7\Request;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Request\Assembler\RequestAssemblerInterface;
use InstaParserBundle\Interaction\Dto\Request\SubscriberRequest;
use Psr\Http\Message\RequestInterface;

final class Assembler implements RequestAssemblerInterface
{
    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|SubscriberRequest $request
     */
    public function assemble(InternalRequestInterface $request): RequestInterface
    {
        return new Request('GET', $request->getSubscriber()->getLink());
    }
}