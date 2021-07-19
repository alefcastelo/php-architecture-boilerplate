<?php

declare(strict_types=1);

namespace Descarga\GraphQL\Resolver\Mutation\Subscriber;

use Descarga\GraphQL\Context;
use Descarga\GraphQL\Resolver;
use Descarga\Subscriber\Input\SubscriberCreateInput;
use Descarga\Subscriber\UseCase\SubscriberCreate;

class SubscriberCreateResolver implements Resolver
{
    public function __construct(
        protected SubscriberCreate $subscriberCreate
    ) {
    }

    public function resolve($rootValue, array $args, Context $context): array
    {
        $input = SubscriberCreateInput::createFromArray($args['input']);

        return (array) $this->subscriberCreate->handler($input);
    }
}
