<?php
namespace App\Shared\Bundles\DDD\Application\ValueObject;

use App\Shared\Bundles\DDD\Domain\ValueObject\ValueObject;

abstract readonly class Actor extends ValueObject
{
    public function __construct(
        private string $identifier,
        private string $displayName
    ) {
    }

    public function __tostring(): string
    {
        return "$this->identifier: $this->displayName";
    }

    public function identifier(): string
    {
        return $this->identifier;
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof static && $other->identifier() === $this->identifier();
    }
}