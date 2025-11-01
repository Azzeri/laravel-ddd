<?php

declare(strict_types=1);

namespace App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent;

use Illuminate\Support\Facades\DB;
use App\Shared\Bundles\DDD\Domain\AggregateRoot;
use App\ReenactmentEvent\Domain\ReenactmentEvent;
use App\Shared\Bundles\DDD\Domain\Exception\DomainEntityNotFoundException;
use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\DomainIdentifier;
use App\ReenactmentEvent\Application\Repository\ReenactmentEventRepository;
use App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\Model\EloquentParticipant;
use App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\Eloquent\AggregateEloquentRepository;
use App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\Model\EloquentReenactmentEvent;

final readonly class ReenactmentEventEloquentRepository extends AggregateEloquentRepository implements ReenactmentEventRepository
{
    public function domainModelClass(): string
    {
        return ReenactmentEvent::class;
    }

    public function persist(AggregateRoot $aggregate): void
    {
        /**
         * @var EloquentReenactmentEvent
         */
        $event = $this->mapDomainToEloquent($aggregate);

        $event->save();

        foreach ($event->participants as $participant) {
            $participant->save();
            $event->participants()->syncWithoutDetaching([$participant]);
        }

    }
}
