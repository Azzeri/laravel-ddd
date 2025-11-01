<?php

namespace App\ReenactmentEvent\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\ReenactmentEvent\Application\Policy\EventManagerCanAddEvent;
use App\Shared\Bundles\DDD\Infrastructure\Providers\DDDServiceProvider;
use App\ReenactmentEvent\Application\Repository\ReenactmentEventRepository;
use App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\ReenactmentEventEloquentRepository;

class ReenactmentEventProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(ReenactmentEventRepository::class, ReenactmentEventEloquentRepository::class);

        $this->app->tag([EventManagerCanAddEvent::class], 'canAddEventPolicies');

    }
}
