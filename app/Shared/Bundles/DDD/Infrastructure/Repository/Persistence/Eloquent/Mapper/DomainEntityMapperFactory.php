<?php
namespace App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\Eloquent\Mapper;

use Illuminate\Container\Attributes\Tag;
use App\Shared\Bundles\DDD\Domain\Exception\ResourceNotFoundException;


final readonly class DomainEntityMapperFactory
{
    public function __construct(#[Tag('eloquentDomainMappers')] private iterable $mappers)
    {

    }

    public function create(string $domainModelClass): DomainEntityMapper
    {
        foreach ($this->mappers as $mapper) {
            if ($mapper->isSatisfiedBy($domainModelClass)) {
                return $mapper;
            }
        }

        throw new \Exception("Mapper for: $domainModelClass not found");
    }
}