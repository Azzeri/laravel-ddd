<?php
namespace App\Shared\Bundles\DDD\Application\Exception;

use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\DomainIdentifier;


class DomainEntityNotFoundException extends ResourceNotFoundException
{
    public static function for(DomainIdentifier $id, string $className): self
    {
        return new self("Domain entity: $id of class: $className not found");
    }
}