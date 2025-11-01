<?php

declare(strict_types=1);
namespace App\ReenactmentEvent\Domain\ValueObject;

use DateTime;
use Carbon\CarbonImmutable;
use App\Shared\Domain\ValueObject\ValueObject;
use App\Shared\Bundles\CommonHelper\ValueObject\DateTimePeriod;

final readonly class Period extends DateTimePeriod
{

}