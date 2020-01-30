<?php

declare(strict_types=1);

namespace App\Service;

class CommissionFeeService
{
    public function cashInFeeCalculator(float $value): float
    {
        $commissionFee = $value * 0.0003;

        if ($commissionFee > 5) {
            $commissionFee = 5;
        }

        return $commissionFee;
    }

    public function legalCashOutFeeCalculator(float $value): float
    {
        $commissionFee = $value * 0.003;

        if ($commissionFee < 0.5) {
            $commissionFee = 0.5;
        }

        return $commissionFee;
    }

    public function naturalCashOutFeeCalculator(string $date, int $userId, float $value, array $data, int $lineNumber): float
    {
        $startOfWeekTimestamp = $this->getStartOfWeekTimestamp($date);
        $endOfWeekTimestamp = $this->getEndOfWeekTimestamp($date);
        $cashOutTimesPerWeek = 0;
        $totalCashOut = 0;

        for ($i = 0; $i < $lineNumber; ++$i) {
            $cashOutDate = new \DateTime($data[$i][0]);
            $cashOutDateTimeStamp = $cashOutDate->getTimestamp();

            if ($cashOutDateTimeStamp >= $startOfWeekTimestamp && $cashOutDateTimeStamp <= $endOfWeekTimestamp && $userId === (int) $data[$i][1] && $data[$i][3] === 'cash_out') {
                ++$cashOutTimesPerWeek;
                $totalCashOut += CurrencyExchange::convertToEuros((float) $data[$i][4], $data[$i][5]);
            }
        }

        if ($cashOutTimesPerWeek < 3 && $totalCashOut < 1000) {
            if ($value + $totalCashOut <= 1000) {
                return 0;
            }

            return ($value + $totalCashOut - 1000) * 0.003;
        }

        return $value * 0.003;
    }

    private function getStartOfWeekTimestamp(string $date): int
    {
        $date = new \DateTime($date);

        if ($date->format('N') === 1) {
            return $date->getTimestamp();
        } else {
            $date->modify('last Monday');

            return $date->getTimestamp();
        }
    }

    private function getEndOfWeekTimeStamp(string $date): int
    {
        $date = new \DateTime($date);

        if ($date->format('N') === 7) {
            return $date->getTimestamp();
        } else {
            $date->modify('next Sunday');

            return $date->getTimestamp();
        }
    }
}
