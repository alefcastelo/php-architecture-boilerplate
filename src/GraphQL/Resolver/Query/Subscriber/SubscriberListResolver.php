<?php

declare(strict_types=1);

namespace Descarga\GraphQL\Resolver\Query\Subscriber;

use Descarga\GraphQL\Context;
use Descarga\GraphQL\Resolver;
use Descarga\Subscriber\Input\SubscriberListFiltersInput;
use Descarga\Subscriber\Output\Mapper\SubscriberListOutputMapper;
use Descarga\Subscriber\SubscriberRepositoryInterface;

class SubscriberListResolver implements Resolver
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberListOutputMapper $subscriberListOutputMapper,
    ) {
    }

    public function resolve($rootValue, array $args, Context $context): array
    {
        $input = SubscriberListFiltersInput::createFromArray([
            'page' => $args['input']['page'] ?? 1,
            'limit' => $args['input']['limit'] ?? 10,
        ]);

        $subscribers = $this->subscriberRepository->list($input);

        return (array) $this->subscriberListOutputMapper->map($subscribers);
    }
}
