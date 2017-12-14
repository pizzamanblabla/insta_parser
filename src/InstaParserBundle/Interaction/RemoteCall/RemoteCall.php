<?php

namespace InstaParserBundle\Interaction\RemoteCall;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleTor\Middleware;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\RequestAssembler\RequestAssemblerInterface;
use InstaParserBundle\Interaction\Response\ResponseFactoryInterface;
use InstaParserBundle\Internal\ObjectBuilder\Exception\InvalidObjectException;
use InstaParserBundle\Internal\ObjectBuilder\ObjectBuilderInterface;
use Pizzamanblabla\DataTransformerBundle\DataExtractor\DataExtractorInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RemoteCall implements RemoteCallInterface
{
    use LoggerAwareTrait;

    /**
     * @var RequestAssemblerInterface
     */
    private $requestAssembler;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var DataExtractorInterface
     */
    private $dataExtractor;

    /**
     * @var ObjectBuilderInterface
     */
    private $objectBuilder;

    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param RequestAssemblerInterface $requestAssembler
     * @param ClientInterface $client
     * @param DataExtractorInterface $dataExtractor
     * @param ObjectBuilderInterface $objectBuilder
     * @param ResponseFactoryInterface $responseFactory
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     */
    public function __construct(
        RequestAssemblerInterface $requestAssembler,
        ClientInterface $client,
        DataExtractorInterface $dataExtractor,
        ObjectBuilderInterface $objectBuilder,
        ResponseFactoryInterface $responseFactory,
        ValidatorInterface $validator,
        LoggerInterface $logger
    ) {
        $this->setLogger($logger);

        $this->requestAssembler = $requestAssembler;
        $this->client = $client;
        $this->dataExtractor = $dataExtractor;
        $this->objectBuilder = $objectBuilder;
        $this->responseFactory = $responseFactory;
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function call(InternalRequestInterface $request): InternalResponseInterface
    {
        $this->logger->info('Trying to build http request');
        $httpRequest = $this->requestAssembler->assemble($request);

//        $this->logger->info('Sending remote request');
//        $httpResponse = $this->setUpClient()->send($httpRequest);
//
//        $this->logger->info('Extracting data from http response');
//        $extracted = $this->dataExtractor->extract($httpResponse);

        //if (!count($extracted)) {
            $this->logger->info('Failed. Sending unmasked remote request');
            $httpResponse = $this->client->send($httpRequest);

            $this->logger->info('Extracting data from http response');
            $extracted = $this->dataExtractor->extract($httpResponse);
        //}

        $this->logger->info('Building internal request');
        return $this->buildInternalRequest($extracted);
    }

    /**
     * @param array $extracted
     * @return InternalResponseInterface
     * @throws InvalidObjectException
     */
    private function buildInternalRequest(array $extracted): InternalResponseInterface
    {
        $response = $this->objectBuilder->build(
            $this->responseFactory->createResponse(),
            $extracted
        );

        $errors = $this->validator->validate($response);

        if (count($errors) > 0) {
            throw new InvalidObjectException((string) $errors);
        }

        return $response;
    }

    /**
     * @return Client
     */
    private function setUpClient()
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $stack->push(Middleware::tor());

        return new Client(['handler' => $stack]);
    }
}