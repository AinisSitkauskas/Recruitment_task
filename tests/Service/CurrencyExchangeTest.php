<?php

declare(strict_types=1);

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\CurrencyExchange;

class CurrencyExchangeTest extends TestCase
{

    /**
     * @var CurrencyExchange
     */
    private $currencyExchange;

    public function setUp()
    {
        $this->currencyExchange = new CurrencyExchange();
    }

    /**
     * @param float $value
     * @param string $currency
     * @param float $result
     *
     * @dataProvider dataProviderForConvertToEuros
     */
    public function testConvertToEuros($value, $currency, $result)
    {
        $this->assertSame($result, $this->currencyExchange->convertToEuros($value, $currency));
    }

    /**
     * @param float $value
     * @param string $currency
     * @param float $result
     *
     * @dataProvider dataProviderForConvertToOriginalCurrency
     */
    public function testConvertToOriginalCurrency($value, $currency, $result)
    {
        $this->assertSame($result, $this->currencyExchange->convertToOriginalCurrency($value, $currency));
    }

    /**
     * @return array
     */
    public function dataProviderForConvertToEuros(): array
    {
        return array(
            [50, 'EUR', 50.0],
            [102, 'EUR', 102.0],
            [153, 'EUR', 153.0],
            [55250, 'EUR', 55250.0],
            [38, 'USD', 33.052100547969],
            [150, 'USD', 130.46881795251],
            [446, 'USD', 387.92728537879],
            [50000, 'JPY', 386.01096271134],
            [1550, 'JPY', 11.966339844052],
            [3254, 'JPY', 25.121593453254]
        );
    }

    /**
     * @return array
     */
    public function dataProviderForConvertToOriginalCurrency(): array
    {
        return array(
            [72, 'EUR', 72.0],
            [58, 'EUR', 58.0],
            [2500, 'EUR', 2500.0],
            [33654, 'EUR', 33654.0],
            [380, 'USD', 436.886],
            [152, 'USD', 174.7544],
            [4460, 'USD', 5127.662],
            [128, 'JPY', 16579.84],
            [49, 'JPY', 6346.97],
            [2588, 'JPY', 335223.64]
        );
    }

}
