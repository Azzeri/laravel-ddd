<?php
namespace App\Shared\Bundles\DDD\Application\Exception;

use App\Shared\Bundles\DDD\Domain\AggregateRoot;
use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\DomainIdentifier;
use App\Shared\Bundles\DDD\Application\Exception\UseCasePolicyExceptionType;


class UseCasePolicyException extends \Exception
{
    public static function ofType(UseCasePolicyExceptionType $type, string $message): self
    {
        return new self($message, $type->value);
    }
}