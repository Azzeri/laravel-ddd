<?php

namespace App\Shared\Bundles\DDD\Domain\ValueObject\Identifier;

use App\Shared\Bundles\DDD\Domain\ValueObject\ValueObject;


abstract readonly class IntegerBasedDomainIdentifier extends DomainIdentifier
{
    public static function fromInt(int $id): self
    {
        return new static($id);
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof self && $this->id === $other->id;
    }


    private function __construct(private int $id)
    {
    }
}