<?php

declare(strict_types=1);

namespace App\ReenactmentEvent\Domain;

use App\Shared\Bundles\DDD\Domain\AggregateRoot;
use App\ReenactmentEvent\Domain\ValueObject\Period;
use App\ReenactmentEvent\Domain\Entity\Participants;
use App\Shared\Bundles\DDD\Domain\Snapshot\Snapshot;
use App\ReenactmentEvent\Domain\ValueObject\ReenactmentEventId;
use App\ReenactmentEvent\Domain\Snapshot\ReenactmentEventSnapshot;
use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\DomainIdentifier;

final class ReenactmentEvent extends AggregateRoot
{
    public function __construct(
        private ReenactmentEventId $id,
        private Period $period,
        private Participants $participants
    ) {
    }

    public function getId(): DomainIdentifier
    {
        return $this->id;
    }

    public function snapshot(): Snapshot
    {
        return new ReenactmentEventSnapshot(
            $this->id,
            $this->period,
            $this->participants
        );
    }

    protected function checkInvariants(): void
    {

    }

}
