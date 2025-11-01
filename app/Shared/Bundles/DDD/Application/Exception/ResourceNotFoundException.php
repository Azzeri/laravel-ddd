<?php
namespace App\Shared\Bundles\DDD\Application\Exception;

use App\Shared\Domain\ValueObject\Identifier\DomainIdentifier;

class ResourceNotFoundException extends \RuntimeException
{
}