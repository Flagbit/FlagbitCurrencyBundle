<?php

namespace Flagbit\Bundle\CurrencyBundle\Tests\Twig;

use Flagbit\Bundle\CurrencyBundle\Service\Currency;
use Flagbit\Bundle\CurrencyBundle\Twig\FlagbitCurrencyExtension;
use Symfony\Component\Intl\Intl;
use Twig_Test_IntegrationTestCase;

class FlagbitCurrencyExtensionTest extends Twig_Test_IntegrationTestCase
{
    public function getExtensions()
    {
        return [
            new FlagbitCurrencyExtension(new Currency(Intl::getCurrencyBundle(), 'EUR')),
        ];
    }

    public function getFixturesDir()
    {
        return __DIR__ . '/Fixtures/';
    }
}
