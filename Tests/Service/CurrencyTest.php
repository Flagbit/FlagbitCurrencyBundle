<?php

namespace Flagbit\Bundle\CurrencyBundle\Tests\Service;

use Flagbit\Bundle\CurrencyBundle\Service\Currency;
use PHPUnit_Framework_MockObject_MockObject;

class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $currencyBundle;

    /**
     * @var Currency
     */
    private $currency;

    protected function setUp()
    {
        $this->currencyBundle = $this->getMockBuilder('Symfony\Component\Intl\ResourceBundle\CurrencyBundleInterface')
            ->getMockForAbstractClass();
        $this->currency = new Currency($this->currencyBundle, 'EUR');
    }

    public function testDefaultCurrency()
    {
        $this->assertEquals('EUR', $this->currency->getDefaultCurrency());
    }

    public function testDefaultCurrencySymbol()
    {
        $this->currencyBundle
            ->expects($this->once())
            ->method('getCurrencySymbol')
            ->with('EUR')
            ->will($this->returnValue('€'));

        $this->assertEquals('€', $this->currency->getCurrencySymbol());
    }

    public function testCurrencySymbol()
    {
        $this->currencyBundle
            ->expects($this->once())
            ->method('getCurrencySymbol')
            ->with('USD')
            ->will($this->returnValue('$'));

        $this->assertEquals('$', $this->currency->getCurrencySymbol('USD'));
    }

    public function testDefaultCurrencyName()
    {
        $this->currencyBundle
            ->expects($this->once())
            ->method('getCurrencyName')
            ->with('EUR')
            ->will($this->returnValue('Euro'));

        $this->assertEquals('Euro', $this->currency->getCurrencyName());
    }

    public function testCurrencyName()
    {
        $this->currencyBundle
            ->expects($this->once())
            ->method('getCurrencyName')
            ->with('USD')
            ->will($this->returnValue('US Dollar'));

        $this->assertEquals('US Dollar', $this->currency->getCurrencyName('USD'));
    }
}
