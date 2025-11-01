<?php
namespace App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Attributes\Tag;
use App\Shared\Bundles\DDD\Domain\AggregateRoot;
use App\Shared\Bundles\DDD\Application\Repository\AggregateRepository;
use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\DomainIdentifier;
use App\Shared\Bundles\DDD\Application\Exception\DomainEntityNotFoundException;
use App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\Eloquent\Mapper\DomainEntityMapperFactory;



abstract readonly class AggregateEloquentRepository implements AggregateRepository
{
    public function __construct(private DomainEntityMapperFactory $mapperFactory)
    {

    }

    abstract public function domainModelClass(): string;

    public function loadById(DomainIdentifier $id): AggregateRoot
    {
        return $this->mapEloquentToDomain($this->findEloquentModel($id));
    }

    public function persist(AggregateRoot $aggregate): void
    {
        $this->mapDomainToEloquent($aggregate)->save();
    }


    public function delete(AggregateRoot $aggregate): void
    {
        $this->findEloquentModel($aggregate->getId())->delete();
    }

    protected function mapDomainToEloquent(AggregateRoot $aggregate): Model
    {
        return $this->mapperFactory->create($this->domainModelClass())
            ->domainToEloquent($aggregate);
    }

    protected function mapEloquentToDomain(Model $model): AggregateRoot
    {
        return $this->mapperFactory->create($this->domainModelClass())
            ->eloquentToDomain($model);
    }

    private function findEloquentModel(DomainIdentifier $id): Model
    {
        $model = $this->domainModelClass()::find((string) $id);
        if (!$model) {
            throw DomainEntityNotFoundException::for($id, $this->domainModelClass());
        }
        return $model;
    }
}
