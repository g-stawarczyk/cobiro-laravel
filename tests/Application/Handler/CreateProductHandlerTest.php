<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Tests\Application\Handler;

use Gstawarczyk\Cobiro\Application\Command\CreateProductCommand;
use Gstawarczyk\Cobiro\Application\Handler\CreateProductHandler;
use Gstawarczyk\Cobiro\Domain\Model\Currency;
use Gstawarczyk\Cobiro\Domain\Model\Money;
use Gstawarczyk\Cobiro\Domain\Model\Uuid;
use Gstawarczyk\Cobiro\Infrastructure\Persistence\InMemory\Repository\InMemoryProductRepository;
use PHPUnit\Framework\TestCase;

class CreateProductHandlerTest extends TestCase
{
    public function test_shouldAddProduct(): void
    {
        $productRepository = new InMemoryProductRepository();
        $handler = new CreateProductHandler(
            $productRepository
        );

        $uuid = $handler->handle(new CreateProductCommand('Lorem Name', 999, 'PLN'));

        $product = $productRepository->findById(Uuid::fromString($uuid));
        self::assertEquals('Lorem Name', $product->getName());
        self::assertTrue((new Money(999, new Currency('PLN')))->equals($product->getPrice()));
    }
}
