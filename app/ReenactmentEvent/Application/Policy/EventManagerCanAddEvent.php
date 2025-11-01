<?php
namespace App\ReenactmentEvent\Application\Policy;

use App\Shared\Bundles\DDD\Application\Dto;
use App\Shared\Bundles\DDD\Application\Exception\UseCasePolicyExceptionType;
use App\Shared\Bundles\DDD\Application\ValueObject\Actor;
use App\Shared\Bundles\DDD\Application\Policy\UseCasePolicy;
use App\Shared\Bundles\DDD\Application\Policy\Notification\UseCasePolicyNotification;
use App\Shared\Bundles\DDD\Application\Policy\Notification\UseCasePolicyNotifications;



final readonly class EventManagerCanAddEvent implements UseCasePolicy
{
    public function isSatisfiedBy(Actor $actor, Dto $dto): UseCasePolicyNotifications
    {
        $notifications = UseCasePolicyNotifications::empty();

        // $notifications->add(UseCasePolicyNotification::ofType(UseCasePolicyExceptionType::UNAUTHORIZED, "Nie wolno"));

        return $notifications;
    }

}