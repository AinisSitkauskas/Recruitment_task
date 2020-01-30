<?php

declare(strict_types=1);

namespace App\Service;

class CurrencyExchange
{
    public static function convertToEuros(float $value, string $currency): ?float
    {
        if ($currency === 'EUR') {
            return $value;
        } elseif ($currency === 'USD') {
            return $value / 1.1497;
        } elseif ($currency === 'JPY') {
            return $value / 129.53;
        } else {
            return null;
        }
    }

    public static function convertToOriginalCurrency(float $value, string $currency): ?float
    {
        if ($currency === 'EUR') {
            return $value;
        } elseif ($currency === 'USD') {
            return $value * 1.1497;
        } elseif ($currency === 'JPY') {
            return $value * 129.53;
        } else {
            return null;
        }
    }
}
