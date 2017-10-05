<?php

namespace InstaParserBundle\Internal\Service;

use InstaParserBundle\Interaction\Dto\Request\CollectionRequest;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestFactoryInterface;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\EmptyInnerSuccessfulResponse;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

final class ProcessCollection implements ServiceInterface
{
    use LoggerAwareTrait;

    /**
     * @var ServiceInterface
     */
    private $decoratedService;

    /**
     * @var InternalRequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var string
     */
    private $method;

    /**
     * @param ServiceInterface $decoratedService
     * @param InternalRequestFactoryInterface $requestFactory
     * @param string $method
     * @param LoggerInterface $logger
     */
    public function __construct(
        ServiceInterface $decoratedService,
        InternalRequestFactoryInterface $requestFactory,
        string $method,
        LoggerInterface $logger
    ) {
        $this->setLogger($logger);

        $this->decoratedService = $decoratedService;
        $this->requestFactory = $requestFactory;
        $this->method = $method;
    }

    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|CollectionRequest $request
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        foreach ($request->getCollection() as $element) {
            $this->decoratedService->behave($this->createInternalRequest($element));
        }

        return new EmptyInnerSuccessfulResponse();
    }

    /**
     * @param mixed $element
     * @return InternalRequestInterface
     */
    private function createInternalRequest($element): InternalRequestInterface
    {
        return
            call_user_func(
                [$this->requestFactory->createRequest(), $this->method],
                $element
            );
    }
}