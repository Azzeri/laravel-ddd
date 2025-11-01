<?php
namespace App\ReenactmentEvent\Domain\Entity;

use App\ReenactmentEvent\Domain\Entity\Participant;
use App\Shared\Bundles\DDD\Domain\ValueObject\Collection\EntityCollection;

final class Participants extends EntityCollection
{
    public function addParticipant(Participant $participant): void
    {
        $this->add($participant);
    }

    public function removeParticipant(Participant $participantToRemove): void
    {
        $this->reject(
            fn(Participant $participant) => $participant->getId()->equals($participantToRemove->getId())
        );
    }
}