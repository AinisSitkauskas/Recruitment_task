<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{

    /**
     * @var NumberFormatter
     */
    private $numberFormatter;

    public function setUp()
    {
        $this->numberFormatter = new NumberFormatter();
    }

    /**
     * @param float $fee
     * @param string $currency
     * @param string $result
     *
     * @dataProvider dataProviderForNumberFormatter
     */
    public function testNumberFormatter($fee, $currency, $result)
    {
        $this->assertSame($result, $this->numberFormatter->formatNumber($fee, $currency));
    }

    /**
     * @return array
     */
    public function dataProviderForNumberFormatter(): array
    {
        return array(
            [64.245, 'EUR', '64.25'],
            [0.4755, 'EUR', '0.48'],
            [14578.447, 'EUR', '14578.45'],
            [457526.414, 'EUR', '457526.42'],
            [451.46554, 'USD', '451.47'],
            [0.3648, 'USD', '0.37'],
            [44484.4444, 'USD', '44484.45'],
            [545.1111, 'JPY', '546'],
            [7999.2455, 'JPY', '8000'],
            [2588.14466, 'JPY', '2589']
        );
    }
}
