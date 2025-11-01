<?php
declare(strict_types=1);

namespace App\ReenactmentEvent\Domain\ValueObject;

use App\Shared\Bundles\DDD\Domain\ValueObject\Identifier\UuidBasedDomainIdentifier;



final readonly class ReenactmentEventId extends UuidBasedDomainIdentifier
{
}