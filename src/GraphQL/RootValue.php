<?php

declare(strict_types=1);

namespace Descarga\GraphQL;

use Descarga\GraphQL\Resolver\Mutation\Subscriber\SubscriberCreateResolver;
use Descarga\GraphQL\Resolver\Mutation\Subscriber\SubscriberUpdateResolver;
use Descarga\GraphQL\Resolver\Query\HealthCheckResolver;
use Descarga\GraphQL\Resolver\Query\Subscriber\SubscriberListResolver;
use Descarga\GraphQL\Resolver\Query\Subscriber\SubscriberRetrieveResolver;

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
            'subscriberRetrieve' => function ($rootValue, $args, Context $context): array {
                return $this->graphQLResolverContainer->resolve(SubscriberRetrieveResolver::class, $rootValue, $args, $context);
            },
            'subscriberList' => function ($rootValue, $args, Context $context): array {
                return $this->graphQLResolverContainer->resolve(SubscriberListResolver::class, $rootValue, $args, $context);
            },
            'subscriberCreate' => function ($rootValue, $args, Context $context): array {
                return $this->graphQLResolverContainer->resolve(SubscriberCreateResolver::class, $rootValue, $args, $context);
            },
            'subscriberUpdate' => function ($rootValue, $args, Context $context): array {
                return $this->graphQLResolverContainer->resolve(SubscriberUpdateResolver::class, $rootValue, $args, $context);
            },
        ];
    }
}
