<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Application\Handler;

use Gstawarczyk\Cobiro\Application\Command\CreateProductCommand;
use Gstawarczyk\Cobiro\Domain\Model\Product;
use Gstawarczyk\Cobiro\Domain\Model\Uuid;
use Gstawarczyk\Cobiro\Domain\Repository\ProductRepository;

class CreateProductHandler implements HandlerInterface
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProductCommand $command): string
    {
        $id = Uuid::next();
        $product = Product::create(
            $id,
            $command->name,
            $command->amount,
            $command->currency
        );

        $this->productRepository->save($product);

        return $id->__toString();
    }
}
