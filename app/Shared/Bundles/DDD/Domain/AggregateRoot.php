<?php

declare(strict_types=1);

namespace App\Shared\Bundles\DDD\Domain;

use App\Shared\Bundles\DDD\Domain\Snapshot\Snapshot;
use App\Shared\Bundles\DDD\Domain\Exception\BusinessLogicException;

abstract class AggregateRoot extends DomainEntity
{
    /**
     *
     * @throws BusinessLogicException
     * @return void
     */
    abstract protected function checkInvariants(): void;

    abstract public function snapshot(): Snapshot;

}
