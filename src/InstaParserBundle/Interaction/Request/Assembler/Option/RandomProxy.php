<?php

namespace InstaParserBundle\Interaction\Request\Assembler\Option;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;

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
        $proxy = $this->proxies[array_rand($this->proxies)];

        return [
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