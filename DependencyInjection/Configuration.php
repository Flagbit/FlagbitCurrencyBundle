<?php

namespace Flagbit\Bundle\CurrencyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('flagbit_currency');

        $rootNode
            ->children()
                ->scalarNode('default_currency')
                    ->info('ISO 4217 currency code')
                    ->validate()
                        ->ifTrue(function($v) {
                            return 1 !== preg_match('/^[A-Z]{3}$/', $v);
                        })
                        ->thenInvalid('Invalid currency code "%s"')
                    ->end()
                    ->defaultValue('EUR')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
