<?php
namespace App\ReenactmentEvent\Domain\Snapshot;

use App\ReenactmentEvent\Domain\ValueObject\Period;
use App\ReenactmentEvent\Domain\Entity\Participants;
use App\Shared\Bundles\DDD\Domain\Snapshot\Snapshot;
use App\ReenactmentEvent\Domain\ValueObject\ReenactmentEventId;

final readonly class ReenactmentEventSnapshot extends Snapshot
{
    public function __construct(
        public ReenactmentEventId $id,
        public Period $period,
        public Participants $participants
    ) {

    }
}