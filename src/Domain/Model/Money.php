<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Domain\Model;

use InvalidArgumentException;

class Money
{
    private int $amount;
    private Currency $currency;

    public function __construct(int $amount, Currency $currency)
    {
        $this->validateAmount($amount);
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function equals(self $money): bool
    {
        return $money->amount === $this->amount && $this->currency->equals($money->currency);
    }

    private function validateAmount(int $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount cannot be negative.');
        }
    }
}
