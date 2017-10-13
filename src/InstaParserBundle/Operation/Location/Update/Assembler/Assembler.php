<?php

namespace InstaParserBundle\Operation\Location\Update\Assembler;

use GuzzleHttp\Psr7\Request;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\RequestAssembler\BaseAssembler;
use InstaParserBundle\Operation\Location\Update\Dto\Request as InternalRequest;
use Psr\Http\Message\RequestInterface;

final class Assembler extends BaseAssembler
{
    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|InternalRequest $request
     */
    public function assemble(InternalRequestInterface $request): RequestInterface
    {
        return new Request($this->method, $this->baseUrl . $request->getLocation()->getCode());
    }
}