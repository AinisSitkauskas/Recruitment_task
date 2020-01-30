<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\CommissionFeeException;
use App\Service\CommissionFeeService;
use App\Service\CurrencyExchange;
use App\Service\NumberFormatter;

class CommissionFeeController
{
    public function showCommissionFee(array $data): void
    {
        $n = count($data);

        for ($i = 0; $i < $n; ++$i) {
            $value = CurrencyExchange::convertToEuros((float) $data[$i][4], $data[$i][5]);

            if (!$value) {
                throw new CommissionFeeException('Error occurred, currency not converted to Euros');
            }

            $commissionFeeService = new CommissionFeeService();

            if ($data[$i][3] === 'cash_in') {
                $fee = $commissionFeeService->cashInFeeCalculator($value);
            } elseif ($data[$i][3] === 'cash_out' && $data[$i][2] === 'legal') {
                $fee = $commissionFeeService->legalCashOutFeeCalculator($value);
            } elseif ($data[$i][3] === 'cash_out' && $data[$i][2] === 'natural') {
                $fee = $commissionFeeService->naturalCashOutFeeCalculator($data[$i][0], (int) $data[$i][1], (float) $value, $data, $i);
            } else {
                throw new CommissionFeeException('Error occurred, not found required commission fee calculator');
            }

            $fee = CurrencyExchange::convertToOriginalCurrency($fee, $data[$i][5]);

            if (!isset($fee)) {
                throw new CommissionFeeException('Error occurred, currency not converted to Original Currency');
            }

            echo NumberFormatter::formatNumber($fee, $data[$i][5]).PHP_EOL;
        }

        return;
    }
}
