<?php
namespace App\Shared\Bundles\DDD\Application\Policy\Notification;

use App\Shared\Bundles\DDD\Application\Exception\UseCasePolicyExceptionType;
use App\Shared\Bundles\DDD\Domain\ValueObject\ValueObject;


final readonly class UseCasePolicyNotification extends ValueObject
{
    private function __construct(private string $message, private UseCasePolicyExceptionType $type)
    {

    }

    public static function ofType(UseCasePolicyExceptionType $type, $message): self
    {
        return new self($message, $type);
    }

    public function __toString()
    {

        return $this->message;
    }

    public function message(): string
    {
        return (string) $this;
    }
    public function type(): UseCasePolicyExceptionType
    {
        return $this->type;
    }
    public function equals(ValueObject $other): bool
    {
        return $other instanceof self && (string) $other === (string) $this;
    }

}