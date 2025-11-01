<?php
namespace App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\Eloquent\Mapper;

use App\Shared\Bundles\DDD\Domain\DomainEntity;
use Illuminate\Database\Eloquent\Model;



interface DomainEntityMapper
{
    public function domainToEloquent(DomainEntity $domainEntity): Model;
    public function eloquentToDomain(Model $eloquentModel): DomainEntity;
    public function isSatisfiedBy(string $domainModelClass): bool;
}