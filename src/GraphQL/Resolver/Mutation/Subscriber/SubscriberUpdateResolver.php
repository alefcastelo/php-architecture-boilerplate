<?php

declare(strict_types=1);

namespace Descarga\GraphQL\Resolver\Mutation\Subscriber;

use Descarga\GraphQL\Context;
use Descarga\GraphQL\Resolver;
use Descarga\Subscriber\Input\SubscriberUpdateInput;
use Descarga\Subscriber\UseCase\SubscriberUpdate;

class SubscriberUpdateResolver implements Resolver
{
    public function __construct(
        protected SubscriberUpdate $subscriberUpdate
    ) {
    }

    public function resolve($rootValue, array $args, Context $context): array
    {
        $input = SubscriberUpdateInput::createFromArray($args['input']);

        return (array) $this->subscriberUpdate->handler($args['id'], $input);
    }
}
