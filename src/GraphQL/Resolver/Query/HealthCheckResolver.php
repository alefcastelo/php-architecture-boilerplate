<?php

declare(strict_types=1);

namespace Descarga\GraphQL\Resolver\Query;

use Descarga\GraphQL\Context;
use Descarga\GraphQL\Resolver;

class HealthCheckResolver implements Resolver
{
    public function resolve($rootValue, array $args, Context $context): array
    {
        return [
            'status' => 'Ok',
            'time' => time(),
        ];
    }
}
