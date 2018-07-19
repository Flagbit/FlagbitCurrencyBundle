<?php

namespace Flagbit\Bundle\CurrencyBundle\Tests;

use Flagbit\Bundle\CurrencyBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    protected function process($config)
    {
        $processor = new Processor();

        return $processor->processConfiguration(new Configuration(), $config);
    }

    public function provideValidCurrency()
    {
        return [
            ['EUR'],
            ['USD'],
            ['CHF'],
        ];
    }

    /**
     * Test Default Currency to prevent BC breaks
     */
    public function testProcessedDefaultCurrency()
    {
        $config = [[]];

        $config = $this->process($config);

        $this->assertEquals('EUR', $config['default_currency']);
    }

    /**
     * @dataProvider provideValidCurrency
     */
    public function testValidDefaultCurrency($currency)
    {
        $config = [
            [
                'default_currency' => $currency,
            ]
        ];

        $config = $this->process($config);

        $this->assertEquals($currency, $config['default_currency']);
    }

    public function provideInvalidCurrency()
    {
        return [
            ['foobar'],
            ['eur'],
        ];
    }

    /**
     * @dataProvider provideInvalidCurrency
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testInvalidDefaultCurrency($currency)
    {
        $config = [
            [
                'default_currency' => $currency,
            ]
        ];

        $this->process($config);
    }
}
