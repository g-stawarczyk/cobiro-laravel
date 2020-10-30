<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Tests\Domain\Model;

use Gstawarczyk\Cobiro\Domain\Model\Currency;
use Gstawarczyk\Cobiro\Domain\Model\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function test_mustBePositiveInt(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Money(-1, new Currency('PLN'));
    }

    /**
     * @dataProvider moneysProvider
     */
    public function test_shouldSaveGivenValues(int $amount, Currency $currency): void
    {
        $money = new Money($amount, $currency);
        self::assertSame($amount, $money->amount());
        self::assertSame($currency, $money->currency());
    }

    public function test_shouldBeEquals(): void
    {
        self::assertTrue((new Money(1, new Currency('PLN')))->equals(new Money(1, new Currency('PLN'))));
    }

    /**
     * @dataProvider differentMoneysProvider
     */
    public function test_shouldNotBeEquals(Money $moneyA, Money $moneyB): void
    {
        self::assertFalse($moneyA->equals($moneyB));
    }

    public function moneysProvider(): array
    {
        return [
            [1, new Currency('PLN')],
            [2, new Currency('PLN')],
            [1, new Currency('USD')],
        ];
    }

    public function differentMoneysProvider(): array
    {
        return [
            [new Money(1, new Currency('PLN')), new Money(2, new Currency('PLN'))],
            [new Money(2, new Currency('PLN')), new Money(1, new Currency('PLN'))],
            [new Money(1, new Currency('PLN')), new Money(1, new Currency('USD'))],
        ];
    }
}
