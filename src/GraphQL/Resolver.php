<?php

declare(strict_types=1);

namespace Descarga\GraphQL;

interface Resolver
{
    public function resolve($rootValue, array $args, Context $context): array;
}
