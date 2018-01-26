<?php

namespace InstaParserBundle\Interaction\Request\Assembler\Option;

use InstaParserBundle\Entity\Tag;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Request\SubscriberRequest;

final class RandomProxy implements OptionAssemblerInterface
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
     */
    public function assemble(InternalRequestInterface $request): array
    {
        /** @var SubscriberRequest $request  */
        $tags = $request->getSubscriber()->getTags();
        $response = [];

        if (count($tags) > 0) {
            $tag = $tags[0];
            /** @var Tag $tag  */
            $proxies = $tag->getProxies();
            if (count($proxies) > 0) {
                $proxy = $proxies[array_rand($proxies)];

                $response = [
                    'proxy' => [
                        'http'  => sprintf(
                            'tcp://%s:%s@%s:%s',
                            $proxy['login'],
                            $proxy['password'],
                            $proxy['ip'],
                            $proxy['port']
                        ),
                        'https'  => sprintf(
                            'tcp://%s:%s@%s:%s',
                            $proxy['login'],
                            $proxy['password'],
                            $proxy['ip'],
                            $proxy['port']
                        ),
                    ]
                ];
            }
        }

        return $response;
    }
}