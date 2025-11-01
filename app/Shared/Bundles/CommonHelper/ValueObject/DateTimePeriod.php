<?php

declare(strict_types=1);
namespace App\Shared\Bundles\CommonHelper\ValueObject;

use App\Shared\Bundles\DateTime\DateTime;
use App\Shared\Bundles\DDD\Domain\ValueObject\ValueObject;


abstract readonly class DateTimePeriod extends ValueObject
{
    public function __construct(private DateTime $start, private DateTime $end)
    {
        if ($end->isBefore($start)) {
            throw new \InvalidArgumentException('End date of period must be after its start date.');
        }
    }

    public function start(): DateTime
    {
        return $this->start;
    }

    public function end(): DateTime
    {
        return $this->end;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s - %s',
            $this->start->toDateString(),
            $this->end->toDateString()
        );
    }

    public function equals(ValueObject $other): bool
    {
        return $other instanceof self &&
            $this->start->equalTo($other->start) &&
            $this->end->equalTo($other->end);
    }
}