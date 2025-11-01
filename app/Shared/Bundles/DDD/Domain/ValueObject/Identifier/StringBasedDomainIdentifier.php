<?php

namespace App\Shared\Bundles\DDD\Domain\ValueObject\Identifier;

use App\Shared\Bundles\DDD\Domain\ValueObject\ValueObject;


abstract readonly class StringBasedDomainIdentifier extends DomainIdentifier
{
    public static function fromString(string $id): self
    {
        return new static($id);
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
    
    public function equals(ValueObject $other): bool
    {
        return $other instanceof self && $this->id === $other->id;
    }

    private function __construct(private string $id)
    {
        $this->id = $id;
    }
}