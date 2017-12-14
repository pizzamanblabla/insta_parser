<?php

namespace InstaParserBundle\Interaction\Assembler\Subscriber;

use GuzzleHttp\Psr7\Request;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Request\SubscriberRequest;
use InstaParserBundle\Interaction\RequestAssembler\RequestAssemblerInterface;
use Psr\Http\Message\RequestInterface;

final class Proxy implements RequestAssemblerInterface
{
    /**
     * @var array
     */
    private $proxies;

    /**
     * @param array $proxies
     */
    public function __construct(array $proxies)
    {
        $this->proxies = $proxies;
    }

    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|SubscriberRequest $request
     */
    public function assemble(InternalRequestInterface $request): RequestInterface
    {
        return
            new Request(
                'GET',
                $request->getSubscriber()->getLink() . '/',
                $this->getProxy()
            );
    }

    /**
     * @return array
     */
    private function getProxy()
    {
        $proxy = $this->proxies[array_rand($this->proxies)];

        return [
            'proxy' => sprintf(
                'http://%s:%s@%s:%s',
                $proxy['login'],
                $proxy['password'],
                $proxy['ip'],
                $proxy['port']),
        ];
    }
}