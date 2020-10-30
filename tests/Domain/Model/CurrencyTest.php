<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Tests\Domain\Model;

use Gstawarczyk\Cobiro\Domain\Model\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function test_mustFollowISO4217Standard(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Currency('PL');
    }

    public function test_shouldBeEquals(): void
    {
        self::assertTrue((new Currency('PLN'))->equals(new Currency('PLN')));
    }

    public function test_shouldNotBeEquals(): void
    {
        self::assertFalse((new Currency('PLN'))->equals(new Currency('USD')));
    }
}
