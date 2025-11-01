<?php

namespace App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use App\Shared\Bundles\DateTime\DateTime;
use App\Shared\Bundles\DDD\Domain\DomainEntity;
use App\ReenactmentEvent\Domain\ReenactmentEvent;
use App\ReenactmentEvent\Domain\ValueObject\Period;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\ReenactmentEvent\Domain\Entity\Participants;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\ReenactmentEvent\Domain\ValueObject\ReenactmentEventId;
use App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\Eloquent\Model\EloquentDomainModel;

class EloquentReenactmentEvent extends Model
{
    use HasUuids;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'start',
        'end'
    ];


    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            EloquentParticipant::class,
            'eloquent_participant_eloquent_reenactment_event',
            'eloquent_reenactment_event_id',
            'eloquent_participant_id'
        );
    }

    // public function toDomainModel(): DomainEntity
    // {
    //     return new ReenactmentEvent(
    //         ReenactmentEventId::fromString($this->id),
    //         new Period(DateTime::parse($this->start), DateTime::parse(time: $this->end)),
    //         new Participants(
    //             $this->participants
    //                 ->map(fn(EloquentParticipant $participant) => $participant->toDomainModel())
    //                 ->all()
    //         )
    //     );
    // }

}
