<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Domain\Repository;

use Gstawarczyk\Cobiro\Domain\Model\Product;
use Gstawarczyk\Cobiro\Domain\Model\Uuid;

interface ProductRepository
{
    public function findById(Uuid $id): ?Product;

    public function save(Product $product): void;
}
