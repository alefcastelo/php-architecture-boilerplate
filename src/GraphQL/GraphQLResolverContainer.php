<?php

declare(strict_types=1);

namespace Descarga\GraphQL;

use InvalidArgumentException;
use Psr\Container\ContainerInterface;

class GraphQLResolverContainer implements ContainerInterface
{
    protected array $resolvers = [];

    public function add($id, Resolver $resolver): void
    {
        $this->resolvers[$id] = $resolver;
    }

    public function get($id): Resolver
    {
        return $this->resolvers[$id];
    }

    public function has($id): bool
    {
        return isset($this->resolvers[$id]);
    }

    public function resolve($id, $rootValue, $args, $context): array
    {
        if (!$this->has($id)) {
            throw new InvalidArgumentException(sprintf('Resolver [%s] not found', $id));
        }

        return $this->get($id)->resolve($rootValue, $args, $context);
    }
}
