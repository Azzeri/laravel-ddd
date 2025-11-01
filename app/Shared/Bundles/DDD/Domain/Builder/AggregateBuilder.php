<?php
namespace App\Shared\Bundles\DDD\Domain\Builder;

use App\Shared\Bundles\DDD\Domain\AggregateRoot;

/**
 * editor.lineheight
 */
abstract class AggregateBuilder
{
    public static function new(): static
    {
        return new static();
    }

    abstract static function withSampleRequiredValues(): self;
    abstract public function build(): AggregateRoot;
}
