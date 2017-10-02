<?php

namespace InstaParserBundle\Operation\Post\Update\Assembler;

use GuzzleHttp\Psr7\Request;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\RequestAssembler\BaseAssembler;
use InstaParserBundle\Operation\Post\Update\Dto\Request as InternalRequest;
use Psr\Http\Message\RequestInterface;

final class Assembler extends BaseAssembler
{
    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|InternalRequest $request
     */
    public function assemble(InternalRequestInterface $request): RequestInterface
    {
        return new Request($this->method, $this->baseUrl . $request->getPost()->getCode());
    }
}