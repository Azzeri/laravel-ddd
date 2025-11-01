<?php

declare(strict_types=1);
namespace App\ReenactmentEvent\Domain\Entity;

use App\Shared\Bundles\DDD\Domain\DomainEntity;
use App\ReenactmentEvent\Domain\ValueObject\ParticipantId;
use App\Shared\Bundles\CommonHelper\ValueObject\PersonName;
use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\DomainIdentifier;

final class Participant extends DomainEntity
{
    public function __construct(
        private ParticipantId $id,
        private PersonName $name,
        private ?string $groupName = null
    ) {
    }

    public function getId(): DomainIdentifier
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getGroupName(): ?string
    {
        return $this->groupName;
    }
}