<?php
namespace App\Shared\Bundles\DDD\Application\Exception;

enum UseCasePolicyExceptionType: int
{
    case UNAUTHORIZED = 403;
    case INVALID_DATA = 422;
}