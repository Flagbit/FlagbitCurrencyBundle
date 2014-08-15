<?php

namespace Flagbit\Bundle\CurrencyBundle\Twig;

use Flagbit\Bundle\CurrencyBundle\Service\Currency;
use Twig_Extension;

class FlagbitCurrencyExtension extends Twig_Extension
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

        return array(
            new \Twig_SimpleFunction('currency_name', function ($currency = null) use ($currencyService) {
                return $currencyService->getCurrencyName($currency);
            }),
            new \Twig_SimpleFunction('currency_symbol', function ($currency = null) use ($currencyService) {
                return $currencyService->getCurrencySymbol($currency);
            }),
        );
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return array(
            'currency' => array(
                'default' => $this->currency->getDefaultCurrency(),
            ),
        );
    }
}
