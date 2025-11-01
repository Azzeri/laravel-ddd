<?php
namespace App\ReenactmentEvent\Domain\Builder;

use App\ReenactmentEvent\Domain\ReenactmentEvent;
use App\ReenactmentEvent\Domain\ValueObject\Period;
use App\ReenactmentEvent\Domain\Entity\Participants;
use App\ReenactmentEvent\Domain\ValueObject\ReenactmentEventId;
use App\Shared\Bundles\DateTime\DateTime;
use App\Shared\Bundles\DDD\Domain\Builder\AggregateBuilder;

final class ReenactmentEventBuilder extends AggregateBuilder
{
    private ReenactmentEventId $id;
    private Period $period;
    private Participants $participants;

    public static function withSampleRequiredValues(): self
    {
        $builder = new self();
        $builder->id = ReenactmentEventId::generate();
        $builder->period = new Period(start: DateTime::now(), end: DateTime::now()->addDays(1));
        $builder->participants = new Participants();
        return $builder;
    }

    public function withId(ReenactmentEventId $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withPeriod(Period $period): self
    {
        $this->period = $period;
        return $this;
    }

    public function withParticipants(Participants $participants): self
    {
        $this->participants = $participants;
        return $this;
    }

    public function build(): ReenactmentEvent
    {
        return new ReenactmentEvent($this->id, $this->period, $this->participants);
    }
}