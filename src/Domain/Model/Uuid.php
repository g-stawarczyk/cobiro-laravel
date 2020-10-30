<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Domain\Model;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

class Uuid
{
    /** @var UuidInterface */
    private UuidInterface $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public static function next(): self
    {
        return new static(RamseyUuid::uuid4());
    }

    public static function fromString(string $uuid): self
    {
        return new static(RamseyUuid::fromString($uuid));
    }

    public function __toString(): string
    {
        return $this->id->toString();
    }
}
