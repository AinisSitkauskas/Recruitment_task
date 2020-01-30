<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\CommissionFeeService;
use PHPUnit\Framework\TestCase;

class CommissionFeeServiceTest extends TestCase
{

    private $commissionFeeService;

    public function setUp()
    {
        $this->commissionFeeService = new CommissionFeeService();
    }

    /**
     * @param float $result
     * @param float $value
     *
     * @dataProvider dataProviderForCashInFeeCalculator
     */
    public function testCashInFeeCalculator($value, $result)
    {
        $this->assertSame($result, $this->commissionFeeService->cashInFeeCalculator($value));
    }

    /**
     * @param float $result
     * @param float $value
     *
     * @dataProvider dataProviderForLegalCashOutFeeCalculator
     */
    public function testLegalCashOutFeeCalculator($value, $result)
    {
        $this->assertSame($result, $this->commissionFeeService->legalCashOutFeeCalculator($value));
    }

    /**
     * @param string $date
     * @param int $userId
     * @param float $value
     * @param array $data
     * @param int $lineNumber
     * @param float $result
     *
     * @dataProvider dataProviderForNaturalCashOutFeeCalculator
     */
    public function testNaturalCashOutFeeCalculator($date, $userId, $value, $data, $lineNumber, $result)
    {
        $this->assertSame($result, $this->commissionFeeService->naturalCashOutFeeCalculator($date, $userId, $value, $data, $lineNumber));
    }


    /**
     * @return array
     */
    public function dataProviderForCashInFeeCalculator(): array
    {
        return array(
            [38, 0.0114],
            [68, 0.0204],
            [5, 0.0015],
            [19000, 5.0],
            [487, 0.1461],
            [5000, 1.5],
            [1547, 0.4641],
            [32, 0.0096],
            [780, 0.234],
            [390000, 5.0]
        );
    }

    /**
     * @return array
     */
    public function dataProviderForLegalCashOutFeeCalculator(): array
    {
        return array(
            [18, 0.5],
            [74, 0.5],
            [4, 0.5],
            [29000, 87.0],
            [587, 1.761],
            [500, 1.5],
            [47, 0.5],
            [321, 0.963],
            [78, 0.5],
            [787, 2.361],
        );
    }

    public function dataProviderForNaturalCashOutFeeCalculator(): array
    {
        return array(
            ['2014-12-31', 4, 1200, array(
                ['2014-12-31', 4, 'natural', 'cash_out', 1200, 'EUR'],
                ['2015-01-01', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-05', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-06', 1, 'natural', 'cash_out', 30000, 'JPY'],
                ['2016-01-07', 1, 'natural', 'cash_out', 1000, 'EUR'],
            ), 0, 0.6],
            ['2015-01-01', 4, 1000, array(
                ['2014-12-31', 4, 'natural', 'cash_out', 1200, 'EUR'],
                ['2015-01-01', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-05', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-06', 1, 'natural', 'cash_out', 30000, 'JPY'],
                ['2016-01-07', 1, 'natural', 'cash_out', 1000, 'EUR'],
            ), 1, 3.0],
            ['2016-01-05', 4, 1000, array(
                ['2014-12-31', 4, 'natural', 'cash_out', 1200, 'EUR'],
                ['2015-01-01', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-05', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-06', 1, 'natural', 'cash_out', 30000, 'JPY'],
                ['2016-01-07', 1, 'natural', 'cash_out', 1000, 'EUR'],
            ), 2, 0.0],
            ['2016-01-06', 1, 30000, array(
                ['2014-12-31', 4, 'natural', 'cash_out', 1200, 'EUR'],
                ['2015-01-01', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-05', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-06', 1, 'natural', 'cash_out', 30000, 'JPY'],
                ['2016-01-07', 1, 'natural', 'cash_out', 1000, 'EUR'],
            ), 3, 87.0],
            ['2016-01-07', 1, 1000, array(
                ['2014-12-31', 4, 'natural', 'cash_out', 1200, 'EUR'],
                ['2015-01-01', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-05', 4, 'natural', 'cash_out', 1000, 'EUR'],
                ['2016-01-06', 1, 'natural', 'cash_out', 30000, 'JPY'],
                ['2016-01-07', 1, 'natural', 'cash_out', 1000, 'EUR'],
            ), 4, 0.694819732880414]
        );
    }

}
