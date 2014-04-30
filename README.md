# FlagbitCurrencyBundle [![Build Status](https://travis-ci.org/Flagbit/FlagbitCurrencyBundle.svg?branch=master)](https://travis-ci.org/Flagbit/FlagbitCurrencyBundle) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/5f19bcf4-a598-489f-baf3-9e4b99a02091/mini.png)](https://insight.sensiolabs.com/projects/5f19bcf4-a598-489f-baf3-9e4b99a02091)

## About

The FlagbitCurrencyBundle provides basic functions to display currency symbols and names.

## Configuration

You can set your default currency. The bundle defaults to EUR. Currency code has to be UPPERCASE.

```yaml
flagbit_currency:
    default_currency: EUR
```

## Services

Fetch the global default currency.

```php
$container->get('flagbit_currency')->getDefaultCurrency(); // EUR
```

Fetch the currency name. Actual output depends on your locale set.

```php
$container->get('flagbit_currency')->getCurrencyName(); // Euro
$container->get('flagbit_currency')->getCurrencyName('EUR'); // Euro
$container->get('flagbit_currency')->getCurrencyName('USD'); // US Dollar
```

Fetch the symbol for the default currency or a given currency.

```php
$container->get('flagbit_currency')->getCurrencySymbol(); // €
$container->get('flagbit_currency')->getCurrencySymbol('EUR'); // €
$container->get('flagbit_currency')->getCurrencySymbol('USD'); // $
```

## Twig

### Functions

#### currency_name

Fetch the currency name. Actual output depends on your locale set.

```twig
{{ currency_name() }} {# example output: Euro #}
{{ currency_name('EUR') }} {# example output: Euro #}
{{ currency_name('USD') }} {# example output: US Dollar #}
```

#### curreny_symbol

Fetch the symbol for the default currency or a given currency.

```twig
{{ currency_symbol() }} {# example output: € #}
{{ currency_symbol('CHF') }} {# example output: CHF #}
{{ currency_symbol('EUR') }} {# example output: € #}
```

### Globals

The default currency code is available as variable.

```twig
{{ currency.default }} {# example output: EUR #}
```
