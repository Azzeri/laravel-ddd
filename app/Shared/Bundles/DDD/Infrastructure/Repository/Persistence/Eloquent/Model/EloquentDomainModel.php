<?php
namespace App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\Eloquent\Model;

use App\Shared\Bundles\DDD\Domain\DomainEntity;


interface EloquentDomainModel // raczej out
{
    public function toDomainModel(): DomainEntity;
}