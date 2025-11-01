<?php
namespace App\Shared\Bundles\DDD\Application\UseCase;


interface TransactionalUseCaseService
{
    public function handleInPersistenceTransaction(\Closure $function): void;
}