<?php
// app/Models/EloquentParticipant.php
namespace App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use App\Shared\Bundles\DDD\Domain\DomainEntity;
use App\ReenactmentEvent\Domain\Entity\Participant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\ReenactmentEvent\Domain\ValueObject\ParticipantId;
use App\Shared\Bundles\CommonHelper\ValueObject\PersonName;
use App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\Eloquent\Model\EloquentDomainModel;

class EloquentParticipant extends Model implements EloquentDomainModel
{
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'second_name',
        'group_name'
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(
            EloquentReenactmentEvent::class,
            'eloquent_participant_eloquent_reenactment_event',
            'eloquent_participant_id',
            'eloquent_reenactment_event_id'
        );
    }
    public function toDomainModel(): DomainEntity
    {
        return new Participant(
            ParticipantId::fromInt($this->id),
            new PersonName(
                $this->first_name,
                $this->last_name,
                $this->second_name
            ),
            $this->group_name // poprawiona nazwa
        );
    }

}
