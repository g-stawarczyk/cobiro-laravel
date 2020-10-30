<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Domain\Model;

use Gstawarczyk\Cobiro\Domain\Exception\ProductNameTooLong;
use Gstawarczyk\Cobiro\Domain\Exception\ProductNameTooShort;

class Product
{
    private Uuid $id;
    private string $name;
    private Money $price;

    private function __construct(Uuid $id, string $name, Money $price)
    {
        $this->validateProductName($name);
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public static function create(?Uuid $productId, string $name, int $amount, string $currency): self
    {
        return new static($productId ?? Uuid::next(), $name, new Money($amount, new Currency($currency)));
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    private function validateProductName(string $name): void
    {
        if (strlen($name) < 2) {
            throw new ProductNameTooShort('Product name must be at least 3 characters length');
        }

        if (strlen($name) > 100) {
            throw new ProductNameTooLong('Product name must be max 100 characters length');
        }
    }
}
