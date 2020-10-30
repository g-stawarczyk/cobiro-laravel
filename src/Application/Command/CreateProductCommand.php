<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Application\Command;

class CreateProductCommand implements Command
{
    public string $name;
    public int $amount;
    public string $currency;

    public function __construct(string $name, int $amount, string $currency)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->currency = $currency;
    }
}
