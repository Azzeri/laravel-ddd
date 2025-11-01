<?php
namespace App\Shared\Bundles\DDD\Application\Policy;

use App\Shared\Bundles\DDD\Application\Dto;
use App\Shared\Bundles\DDD\Application\Policy\Notification\UseCasePolicyNotifications;
use App\Shared\Bundles\DDD\Application\ValueObject\Actor;


interface UseCasePolicy
{
    public function isSatisfiedBy(Actor $actor, Dto $dto): UseCasePolicyNotifications;
}