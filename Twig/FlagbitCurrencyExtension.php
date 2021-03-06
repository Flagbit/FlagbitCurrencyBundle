<?php

namespace Flagbit\Bundle\CurrencyBundle\Twig;

use Flagbit\Bundle\CurrencyBundle\Service\Currency;
use Twig_Extension;
use Twig_Extension_GlobalsInterface;

class FlagbitCurrencyExtension extends Twig_Extension implements Twig_Extension_GlobalsInterface
{
    /**
     * @var Currency
     */
    private $currency;

    /**
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'flagbit_currency';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        $currencyService = $this->currency;

        return [
            new \Twig_SimpleFunction('currency_name', function ($currency = null) use ($currencyService) {
                return $currencyService->getCurrencyName($currency);
            }),
            new \Twig_SimpleFunction('currency_symbol', function ($currency = null) use ($currencyService) {
                return $currencyService->getCurrencySymbol($currency);
            }),
        ];
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return [
            'currency' => [
                'default' => $this->currency->getDefaultCurrency(),
            ],
        ];
    }
}
