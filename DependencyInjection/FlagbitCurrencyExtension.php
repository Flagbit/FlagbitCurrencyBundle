<?php

namespace Flagbit\Bundle\CurrencyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class FlagbitCurrencyExtension extends Extension
{
    /**
     * @param array            $config
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     *
     * @api
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $config);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container->findDefinition('flagbit_currency')
            ->setArgument(1, $config['default_currency']);
    }
}
