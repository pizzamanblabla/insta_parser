<?php

namespace InstaParserBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class InstaParserExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        foreach ($this->getConfigurationList() as $config) {
            $loader->load($config);
        }
    }

    /**
     * @return string[]
     */
    private function getConfigurationList()
    {
        return [
            'location/update.yml',
            'post/update.yml',
            'statistic/parameters.yml',
            'subscriber/get_info.yml',
            'common.yml',
            'command.yml',
            'controller.yml',
            'services.yml',
            'parameters.yml',
        ];
    }
}