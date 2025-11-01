<?php
namespace App\Shared\Bundles\DDD\Application\Factory;

use App\Shared\Bundles\DDD\Application\ValueObject\Actor;

interface ActorFactory
{
    public function create(string $actorClass): Actor;
}