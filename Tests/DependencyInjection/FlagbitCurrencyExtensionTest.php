<?php

namespace Flagbit\Bundle\CurrencyBundle\Tests;

use Flagbit\Bundle\CurrencyBundle\DependencyInjection\FlagbitCurrencyExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FlagbitCurrencyExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testCurrencyServiceIntegration()
    {
        $container = new ContainerBuilder();
        $config = array();

        $extension = new FlagbitCurrencyExtension();
        $extension->load($config, $container);

        $definition = $container->findDefinition('flagbit_currency.twig');
        $definition->setPublic(true);

        $container->compile();

        $currencyBundle = $container->get('flagbit_currency.intl_bundle');
        $currency = $container->get('flagbit_currency');
        $currencyExtension = $container->get('flagbit_currency.twig');

        $this->assertInstanceOf('Symfony\Component\Intl\ResourceBundle\CurrencyBundleInterface', $currencyBundle);
        $this->assertInstanceOf('Flagbit\Bundle\CurrencyBundle\Service\Currency', $currency);
        $this->assertInstanceOf('Flagbit\Bundle\CurrencyBundle\Twig\FlagbitCurrencyExtension', $currencyExtension);
    }
}
