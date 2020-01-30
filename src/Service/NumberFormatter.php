<?php

declare(strict_types=1);

namespace App\Service;

class NumberFormatter
{
    public static function formatNumber(float $fee, string $currency): string
    {
        $fee = round($fee, 3);

        if ($currency === 'JPY') {
            $fee = ceil($fee);

            return number_format($fee, 0, '.', '');
        } else {
            $fee = ceil($fee * 100) / 100;

            return number_format($fee, 2, '.', '');
        }
    }
}
