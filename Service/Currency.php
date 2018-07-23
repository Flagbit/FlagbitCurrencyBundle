<?php

namespace Flagbit\Bundle\CurrencyBundle\Service;

use Symfony\Component\Intl\ResourceBundle\CurrencyBundleInterface;

class Currency
{
    /**
     * @var string
     */
    private $defaultCurrency;

    /**
     * @var CurrencyBundleInterface
     */
    private $currencyBundle;

    /**
     *
     * @param CurrencyBundleInterface $currencyBundle
     * @param string                  $defaultCurrency ISO 4217 currency code
     */
    public function __construct(CurrencyBundleInterface $currencyBundle, $defaultCurrency)
    {
        $this->currencyBundle = $currencyBundle;
        $this->defaultCurrency = $defaultCurrency;
    }

    /**
     * @param string $currency ISO 4217 currency code
     *
     * @return string Name like "Euro" or "Schweizer Franken"
     */
    public function getCurrencyName($currency = null)
    {
        if (null === $currency) {
            $currency = $this->defaultCurrency;
        }

        return $this->currencyBundle->getCurrencyName($currency);
    }

    /**
     * @param string $currency ISO 4217 currency code
     *
     * @return string Symbol like "€" or "CHF"
     */
    public function getCurrencySymbol($currency = null)
    {
        if (null === $currency) {
            $currency = $this->defaultCurrency;
        }

        return $this->currencyBundle->getCurrencySymbol($currency);
    }

    /**
     * @return string ISO 4217 currency code
     */
    public function getDefaultCurrency()
    {
        return $this->defaultCurrency;
    }
}
