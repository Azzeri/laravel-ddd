<?php

namespace App\Shared\Bundles\DDD\Domain\ValueObject;

abstract readonly class ValueObject implements \Stringable
{
    abstract public function equals(ValueObject $other): bool;
}