<?php
namespace App\Shared\Bundles\DDD\Infrastructure\Factory\Actor;

use App\Shared\Bundles\DDD\Application\ValueObject\Actor;
use App\Shared\Bundles\DDD\Application\Factory\ActorFactory;
use Exception;


final readonly class ActorFromAuthenticatedUserFactory implements ActorFactory
{
    public function create(string $actorClass): Actor
    {
        if (!is_subclass_of($actorClass, Actor::class)) {
            throw new Exception("$actorClass must be extension of App\Shared\Bundles\DDD\Application\ValueObject\Actor");
        }
        $user = auth()?->user();

        if ($user === null) {
             return new $actorClass(
                'mockedId',
                "mockedName"
            );
            throw new Exception("Unauthenticated");
           
        }

        return new $actorClass(
            $user->id,
            $user->name
        );
    }

}