<?php

namespace Flagbit\Bundle\CurrencyBundle\Tests;

use Flagbit\Bundle\CurrencyBundle\DependencyInjection\FlagbitCurrencyExtension;
use Flagbit\Bundle\CurrencyBundle\Service\Currency;
use Flagbit\Bundle\CurrencyBundle\Twig\FlagbitCurrencyExtension as TwigExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Intl\ResourceBundle\CurrencyBundleInterface;

class FlagbitCurrencyExtensionTest extends TestCase
{
    public function testCurrencyServiceIntegration()
    {
        $container = new ContainerBuilder();
        $config = [];

        $extension = new FlagbitCurrencyExtension();
        $extension->load($config, $container);

        $definition = $container->findDefinition('flagbit_currency.twig');
        $definition->setPublic(true);

        $container->compile();

        $currencyBundle = $container->get('flagbit_currency.intl_bundle');
        $currency = $container->get('flagbit_currency');
        $currencyExtension = $container->get('flagbit_currency.twig');

        $this->assertInstanceOf(CurrencyBundleInterface::class, $currencyBundle);
        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertInstanceOf(TwigExtension::class, $currencyExtension);
    }
}
