<?php
namespace App\ReenactmentEvent\Application\Dto;

use App\Shared\Bundles\DDD\Application\Dto;

final readonly class ReenactmentEventRequestData extends Dto
{
    public function __construct(
        public string $start,
        public string $end,
        public array $participants,
        public ?string $id
    )
    {

    }
}