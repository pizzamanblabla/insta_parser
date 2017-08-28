<?php

namespace InstaParserBundle\Interaction\Assembler\Subscriber;

use GuzzleHttp\Psr7\Request;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Request\SubscriberRequest;
use InstaParserBundle\Interaction\RequestAssembler\RequestAssemblerInterface;
use Psr\Http\Message\RequestInterface;

final class Assembler implements RequestAssemblerInterface
{
    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|SubscriberRequest $request
     */
    public function assemble(InternalRequestInterface $request): RequestInterface
    {
        return
            new Request(
                'GET',
                $request->getSubscriber()->getLink() . '/'
            );
    }
}