<?php
namespace App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence;

use Illuminate\Support\Facades\DB;
use App\Shared\Bundles\DDD\Application\UseCase\TransactionalUseCaseService;

final readonly class TransactionalUseCaseServiceImpl implements TransactionalUseCaseService
{
    public function handleInPersistenceTransaction(\Closure $function): void
    {
        DB::transaction($function);
    }
}