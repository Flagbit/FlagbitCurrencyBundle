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

        $container->compile();

        $currencyBundle = $container->get('flagbit_currency.intl_bundle');
        $currency = $container->get('flagbit_currency');

        $this->assertInstanceOf('Symfony\Component\Intl\ResourceBundle\CurrencyBundleInterface', $currencyBundle);
        $this->assertInstanceOf('Flagbit\Bundle\CurrencyBundle\Service\Currency', $currency);
    }
}
