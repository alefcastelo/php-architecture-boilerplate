<?php

declare(strict_types=1);

namespace Descarga\GraphQL\Config;

use Descarga\GraphQL\GraphQLResolverContainer;
use Descarga\GraphQL\Resolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class GraphQLResolversCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(GraphQLResolverContainer::class)) {
            return;
        }

        $definition = $container->findDefinition(GraphQLResolverContainer::class);
        $taggedServices = $container->findTaggedServiceIds('graphql.resolvers');

        foreach ($taggedServices as $id => $tags) {
            if (!is_a($id, Resolver::class, true)) {
                continue;
            }

            $definition->addMethodCall('add', [$id, new Reference($id)]);
        }
    }
}
