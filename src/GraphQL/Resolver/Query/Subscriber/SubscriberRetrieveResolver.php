<?php

declare(strict_types=1);

namespace Descarga\GraphQL\Resolver\Query\Subscriber;

use Descarga\GraphQL\Context;
use Descarga\GraphQL\Resolver;
use Descarga\Subscriber\Output\Mapper\SubscriberFullOutputMapper;
use Descarga\Subscriber\SubscriberRepositoryInterface;

class SubscriberRetrieveResolver implements Resolver
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberFullOutputMapper $subscriberFullOutputMapper,
    ) {
    }

    public function resolve($rootValue, array $args, Context $context): array
    {
        $subscriber = $this->subscriberRepository->getById($args['id']);

        return (array) $this->subscriberFullOutputMapper->map($subscriber);
    }
}
