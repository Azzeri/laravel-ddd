<?php

namespace App\Shared\Bundles\DDD\Infrastructure\Providers;

use App\Shared\Bundles\DDD\Application\Factory\ActorFactory;
use App\Shared\Bundles\DDD\Application\UseCase\TransactionalUseCaseService;
use App\Shared\Bundles\DDD\Infrastructure\Factory\Actor\ActorFromAuthenticatedUserFactory;
use App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\TransactionalUseCaseServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\ReenactmentEvent\Application\Repository\ReenactmentEventRepository;
use App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\ReenactmentEventEloquentRepository;

class DDDServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // $this->app->bind(TransactionalUseCaseService::class, TransactionalUseCaseServiceImpl::class);
        $this->app->bind(ActorFactory::class, ActorFromAuthenticatedUserFactory::class);
    }
}
