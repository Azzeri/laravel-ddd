<?php

namespace App\Shared\Bundles\DDD\Domain\ValueObject\Identifier;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use App\Shared\Bundles\DDD\Domain\ValueObject\ValueObject;

abstract readonly class UuidBasedDomainIdentifier extends DomainIdentifier
{
    private UuidInterface $uuid;

    public static function generate(): static
    {
        return new static(Uuid::uuid4()->toString());
    }

    public static function fromString(string $uuid): static
    {
        return new static($uuid);
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof self && $this->uuid->equals($other->uuid);
    }

    private function __construct(string $uuid)
    {
        if (!Uuid::isValid($uuid)) {
            throw new \InvalidArgumentException("Invalid UUID: $uuid");
        }
        $this->uuid = Uuid::fromString($uuid);
    }
}