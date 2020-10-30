<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Domain\Model;

use InvalidArgumentException;

class Currency
{
    private string $currency;

    public function __construct(string $currency)
    {
        $this->validateCurrency($currency);
        $this->currency = $currency;
    }

    public function equals(self $currency): bool
    {
        return $currency->currency === $this->currency;
    }

    private function validateCurrency(string $currency): void
    {
        if (strlen($currency) !== 3) {
            throw new InvalidArgumentException('Currency must follow ISO 4217 Standard.');
        }
    }
}
