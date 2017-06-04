<?php

namespace InstaParserBundle\Operation\Statistics\Update\Subscriber\Assembler;

use GuzzleHttp\Psr7\Request;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\RequestAssembler\RequestAssemblerInterface;
use InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Request\Request as InternalRequest;
use Psr\Http\Message\RequestInterface;

final class Assembler implements RequestAssemblerInterface
{
    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|InternalRequest $request
     */
    public function assemble(InternalRequestInterface $request): RequestInterface
    {
        return new Request('GET', $request->getSubscriber()->getLink());
    }
}