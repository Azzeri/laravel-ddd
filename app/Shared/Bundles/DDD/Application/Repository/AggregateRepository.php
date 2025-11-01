<?php
namespace App\Shared\Bundles\DDD\Application\Repository;

use App\Shared\Bundles\DDD\Domain\AggregateRoot;
use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\DomainIdentifier;
use App\Shared\Bundles\DDD\Application\Exception\DomainEntityNotFoundException;


/**
 * @template T of AggregateRoot
 * @template TId of DomainIdentifier
 */
interface AggregateRepository
{
    /**
     * @param TId $id
     * @throws DomainEntityNotFoundException
     * @return T
     */
    public function loadById(DomainIdentifier $id): AggregateRoot;

    /**
     * @param T $aggregate
     * @return void
     */
    public function persist(AggregateRoot $aggregate): void;

    /**
     * @param T $aggregate
     * @return void
     */
    public function delete(AggregateRoot $aggregate): void;
}
