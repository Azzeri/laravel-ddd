<?php
namespace App\Shared\Bundles\DDD\Application\Policy\Notification;

use App\Shared\Bundles\DDD\Application\Exception\UseCasePolicyException;
use App\Shared\Bundles\DDD\Application\Exception\UseCasePolicyExceptionType;
use App\Shared\Bundles\DDD\Domain\ValueObject\Collection\ValueObjectCollection;


final class UseCasePolicyNotifications extends ValueObjectCollection
{
    // private array $notifications = [];

    public static function empty(): self
    {
        return new self();
    }

    public static function withNotifications(array $notifications): self
    {
        return new self($notifications);
        // $instance->notifications = $notifications;
        // return $instance;
    }

    public function notifications(): array
    {
        return $this->items;
    }

    public function notificationsToJson(): string
    {
        return collect($this->items)
            ->map(fn($n) => $n->message())
            ->toJson();
    }

    /**
     * @throws UseCasePolicyException
     * @return void
     */
    public function validate(): void
    {
        if ($this->isEmpty()) {
            return;
        }

        $authorizationExceptions = $this->filter(
            fn(UseCasePolicyNotification $notification)
            => $notification->type() === UseCasePolicyExceptionType::UNAUTHORIZED
        );

        if ($authorizationExceptions->isNotEmpty()) {
            dd($authorizationExceptions->notificationsToJson());
            throw UseCasePolicyException::ofType(
                UseCasePolicyExceptionType::UNAUTHORIZED,
                (string) $authorizationExceptions->notificationsToJson()
            );
        }

        throw UseCasePolicyException::ofType(
            UseCasePolicyExceptionType::INVALID_DATA,
            json_encode($this->items)
        );

    }
}