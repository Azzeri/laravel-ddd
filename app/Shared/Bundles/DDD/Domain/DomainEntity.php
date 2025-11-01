<?php

declare(strict_types=1);

namespace App\Shared\Bundles\DDD\Domain;

use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\DomainIdentifier;


abstract class DomainEntity
{
    abstract public function getId(): DomainIdentifier;
}
