<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Infrastructure\Persistence\InMemory\Repository;

use Gstawarczyk\Cobiro\Domain\Model\Product;
use Gstawarczyk\Cobiro\Domain\Model\Uuid;
use Gstawarczyk\Cobiro\Domain\Repository\ProductRepository;

class InMemoryProductRepository implements ProductRepository
{
    private array $products;

    public function findById(Uuid $id): ?Product
    {
        return $this->products[$id->__toString()] ?? null;
    }

    public function save(Product $product): void
    {
        $this->products[$product->getId()->__toString()] = $product;
    }
}
