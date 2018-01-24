<?php

namespace InstaParserBundle\Interaction\Request\Assembler;

use GuzzleHttp\Psr7\Request;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Request\Assembler\Header\HeaderAssemblerInterface;
use InstaParserBundle\Interaction\Request\Assembler\Url\UrlAssemblerInterface;
use Psr\Http\Message\RequestInterface;

final class Assembler implements RequestAssemblerInterface
{
    /**
     * @var UrlAssemblerInterface
     */
    private $urlAssembler;

    /**
     * @var HeaderAssemblerInterface
     */
    private $headerAssembler;

    /**
     * @var string
     */
    private $method;

    /**
     * @param UrlAssemblerInterface $urlAssembler
     * @param HeaderAssemblerInterface $headerAssembler
     * @param string $method
     */
    public function __construct(
        UrlAssemblerInterface $urlAssembler,
        HeaderAssemblerInterface $headerAssembler,
        string $method
    ) {
        $this->urlAssembler = $urlAssembler;
        $this->headerAssembler = $headerAssembler;
        $this->method = $method;
    }

    /**
     * {@inheritdoc}
     */
    public function assemble(InternalRequestInterface $request): RequestInterface
    {
        return
            new Request(
                $this->method,
                $this->urlAssembler->assemble($request),
                $this->headerAssembler->assemble($request)
            );
    }
}