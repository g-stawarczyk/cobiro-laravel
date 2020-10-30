<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Tests\Domain\Model;

use Gstawarczyk\Cobiro\Domain\Exception\ProductNameTooLong;
use Gstawarczyk\Cobiro\Domain\Exception\ProductNameTooShort;
use Gstawarczyk\Cobiro\Domain\Model\Currency;
use Gstawarczyk\Cobiro\Domain\Model\Money;
use Gstawarczyk\Cobiro\Domain\Model\Product;
use Gstawarczyk\Cobiro\Domain\Model\Uuid;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function test_nameMustBeMinimum2CharactersLong(): void
    {
        $this->expectException(ProductNameTooShort::class);
        Product::create(
            Uuid::next(),
            'A',
            1,
            'PLN'
        );
    }

    public function test_nameMustBeMaximum100CharactersLong(): void
    {
        $productName = str_repeat('A', 101);
        $this->expectException(ProductNameTooLong::class);
        Product::create(
            Uuid::next(),
            $productName,
            1,
            'PLN'
        );
    }

    /**
     * @dataProvider validProductNameProvider
     */
    public function test_shouldSaveGivenValues(string $productName): void
    {
        $product = Product::create(
            Uuid::next(),
            $productName,
            999,
            'PLN'
        );
        self::assertSame($product->getName(), $productName);
        self::assertTrue($product->getPrice()->equals(new Money(999, new Currency('PLN'))));
    }

    public function validProductNameProvider(): array
    {
        return [
            [str_repeat('A', 100)],
            [str_repeat('A', 2)],
            [str_repeat('A', 10)],
            [str_repeat('A', 50)],
        ];
    }
}
