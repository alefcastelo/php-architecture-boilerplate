<?php

declare(strict_types=1);

namespace Descarga\GraphQL;

use Descarga\GraphQL\Resolver\Query\HealthCheckResolver;

class RootValue
{
    protected GraphQLResolverContainer $graphQLResolverContainer;

    public function __construct(
        GraphQLResolverContainer $graphQLResolverContainer,
    ) {
        $this->graphQLResolverContainer = $graphQLResolverContainer;
    }

    public function getRootValue(): array
    {
        return [
            'healthcheck' => function ($rootValue, $args, Context $context): array {
                return $this->graphQLResolverContainer->resolve(HealthCheckResolver::class, $rootValue, $args, $context);
            },
        ];
    }
}
