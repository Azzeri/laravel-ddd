<?php

namespace App\Shared\Bundles\CommonHelper\ValueObject;

use App\Shared\Bundles\DDD\Domain\ValueObject\ValueObject;


final readonly class PersonName extends ValueObject
{
    public function __construct(
        private string $firstName,
        private string $lastName,
        private ?string $secondName = null
    ) {
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }
    public function secondName(): ?string
    {
        return $this->secondName;
    }

    public function initials(): string
    {
        $initials = $this->firstName[0];
        if ($this->secondName) {
            $initials .= $this->secondName[0];
        }
        $initials .= $this->lastName[0];
        return strtoupper($initials);
    }

    public function fullName(): string
    {
        return "$this->firstName $this->secondName $this->lastName";
    }

    public function __tostring(): string
    {
        return $this->fullName();
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof self &&
            $this->firstName === $other->firstName &&
            $this->lastName === $other->lastName &&
            $this->secondName === $other->secondName;
    }
}
