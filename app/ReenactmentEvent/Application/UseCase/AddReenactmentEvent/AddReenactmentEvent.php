<?php
namespace App\ReenactmentEvent\Application\UseCase\AddReenactmentEvent;

use Illuminate\Container\Attributes\Tag;
use App\Shared\Bundles\DateTime\DateTime;
use App\Shared\Bundles\DDD\Application\Dto;
use App\ReenactmentEvent\Domain\ReenactmentEvent;
use App\ReenactmentEvent\Domain\Entity\Participant;
use App\ReenactmentEvent\Domain\ValueObject\Period;
use App\ReenactmentEvent\Domain\Entity\Participants;
use App\Shared\Bundles\DDD\Application\UseCase\UseCase;
use App\ReenactmentEvent\Domain\ValueObject\ParticipantId;
use App\Shared\Bundles\CommonHelper\ValueObject\PersonName;
use App\Shared\Bundles\DDD\Application\Factory\ActorFactory;
use App\ReenactmentEvent\Application\ValueObject\EventManager;
use App\ReenactmentEvent\Domain\ValueObject\ReenactmentEventId;
use App\ReenactmentEvent\Domain\Builder\ReenactmentEventBuilder;
use App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\ReenactmentEventEloquentRepository;


final readonly class AddReenactmentEvent extends UseCase
{
    public function __construct(
        private ReenactmentEventEloquentRepository $repository,
        #[Tag('canAddEventPolicies')] iterable $policies = [],
        private ActorFactory $actorFactory
    ) {
        parent::__construct($policies, $actorFactory);
    }

    /**
     * Summary of handle
     * @template T of Dto
     * @param T $dto
     * @return void
     */
    public function handle(Dto $dto): void
    {
        // dodac fabryke agregatu

        $event = ReenactmentEventBuilder::new()
            ->withId(ReenactmentEventId::generate())
            ->withPeriod(new Period(DateTime::now()->addMonth(), DateTime::now()->addMonths(2)))
            ->withParticipants(
                new Participants([
                    new Participant(
                        ParticipantId::fromInt(1),
                        new PersonName(
                            "John",
                            "Doe",
                            "Mary"
                        ),
                        "Aesir"
                    ),
                    new Participant(
                        ParticipantId::fromInt(2),
                        new PersonName(
                            "Jane",
                            "Mary",
                        ),
                        "Aesir"
                    )
                ])
            )->build();


        $this->repository->persist($event);
    }

    protected function actorClass(): string
    {
        return EventManager::class;
    }

}
