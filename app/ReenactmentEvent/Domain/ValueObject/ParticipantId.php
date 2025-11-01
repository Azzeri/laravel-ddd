<?php
declare(strict_types=1);

namespace App\ReenactmentEvent\Domain\ValueObject;

use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\IntegerBasedDomainIdentifier;



final readonly class ParticipantId extends IntegerBasedDomainIdentifier
{
}