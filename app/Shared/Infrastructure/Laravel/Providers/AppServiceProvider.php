<?php

namespace App\Shared\Infrastructure\Laravel\Providers;

use App\ReenactmentEvent\Infrastructure\Providers\ReenactmentEventProvider;
use App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\Mapper\ReenactmentEventMapper;
use App\Shared\Bundles\DDD\Infrastructure\Providers\DDDServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(DDDServiceProvider::class);
        $this->app->register(ReenactmentEventProvider::class);

        $this->app->tag([ReenactmentEventMapper::class], 'eloquentDomainMappers');
    }
}
