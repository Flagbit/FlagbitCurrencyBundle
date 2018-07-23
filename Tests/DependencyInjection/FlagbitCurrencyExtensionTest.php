<?php

namespace Flagbit\Bundle\CurrencyBundle\Tests;

use Flagbit\Bundle\CurrencyBundle\DependencyInjection\FlagbitCurrencyExtension;
use Flagbit\Bundle\CurrencyBundle\Service\Currency;
use Flagbit\Bundle\CurrencyBundle\Twig\FlagbitCurrencyExtension as TwigExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Intl\ResourceBundle\CurrencyBundleInterface;

class FlagbitCurrencyExtensionTest extends TestCase
{
    public function testCurrencyServiceIntegration()
    {
        $container = new ContainerBuilder();
        $config = [];

        $extension = new FlagbitCurrencyExtension();
        $extension->load($config, $container);

        $this->setDefinitionPublic(TwigExtension::class, $container);
        $this->setDefinitionPublic(Currency::class, $container);

        $container->compile();

        $currency = $container->get(Currency::class);
        $currencyExtension = $container->get(TwigExtension::class);

        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertInstanceOf(TwigExtension::class, $currencyExtension);

        $currencyBundle = $container->get('flagbit_currency.intl_bundle');
        $currency = $container->get('flagbit_currency');

        $this->assertInstanceOf(CurrencyBundleInterface::class, $currencyBundle);
        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertInstanceOf(TwigExtension::class, $currencyExtension);
    }

    /**
     * @param string           $serviceName
     * @param ContainerBuilder $container
     */
    private function setDefinitionPublic(string $serviceName, ContainerBuilder $container)
    {
        $container->findDefinition($serviceName)
            ->setPublic(true);
    }
}
