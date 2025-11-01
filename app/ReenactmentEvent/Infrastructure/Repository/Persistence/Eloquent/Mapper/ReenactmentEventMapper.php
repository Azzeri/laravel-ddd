<?php
namespace App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\Mapper;

use Illuminate\Database\Eloquent\Model;
use App\Shared\Bundles\DateTime\DateTime;
use App\Shared\Bundles\DDD\Domain\DomainEntity;
use App\ReenactmentEvent\Domain\ReenactmentEvent;
use App\ReenactmentEvent\Domain\Entity\Participant;
use App\ReenactmentEvent\Domain\ValueObject\Period;
use App\ReenactmentEvent\Domain\Entity\Participants;
use App\ReenactmentEvent\Domain\ValueObject\ParticipantId;
use App\Shared\Bundles\CommonHelper\ValueObject\PersonName;
use App\ReenactmentEvent\Domain\ValueObject\ReenactmentEventId;
use App\User\Infrastructure\Repository\Persistence\Eloquent\User;
use App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\Model\EloquentParticipant;
use App\Shared\Bundles\DDD\Infrastructure\Repository\Persistence\Eloquent\Mapper\DomainEntityMapper;
use App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\Model\EloquentReenactmentEvent;


final readonly class ReenactmentEventMapper implements DomainEntityMapper
{
    /**
     * Summary of domainToEloquent
     * @param ReenactmentEvent $domainEntity
     * @return void
     */
    public function domainToEloquent(DomainEntity $domainEntity): Model
    {
        /**
         * @var  \App\ReenactmentEvent\Domain\Snapshot\ReenactmentEventSnapshot
         */
        $snapshot = $domainEntity->snapshot();
        $event = new EloquentReenactmentEvent([
            'id' => (string) $domainEntity->getId(),
            'start' => $snapshot->period->start()->toDateString(),
            'end' => $snapshot->period->end()->toDateString(),
        ]);

        $participants = collect();
        foreach ($snapshot->participants as $p) {
            $participants->push(new EloquentParticipant([
                'first_name' => $p->getName()->firstName(),
                'last_name' => $p->getName()->lastName(),
                'second_name' => $p->getName()->secondName(),
                'group_name' => $p->getGroupName(),
            ]));
        }

        $event->setRelation('participants', $participants);

        return $event;
    }
    public function eloquentToDomain(Model $eloquentModel): DomainEntity
    {
        return new ReenactmentEvent(
            ReenactmentEventId::fromString($eloquentModel->id),
            new Period(DateTime::parse($eloquentModel->start), DateTime::parse(time: $eloquentModel->end)),
            new Participants(
                $eloquentModel->participants
                    ->map(fn(EloquentParticipant $participant) => $participant->toDomainModel())
                    ->all()
            )
        );
    }
    public function isSatisfiedBy(string $domainModelClass): bool
    {
        return $domainModelClass === ReenactmentEvent::class;
    }
}