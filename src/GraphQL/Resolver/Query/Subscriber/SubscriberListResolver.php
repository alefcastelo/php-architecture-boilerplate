<?php

declare(strict_types=1);

namespace Descarga\GraphQL\Resolver\Query\Subscriber;

use Descarga\GraphQL\Context;
use Descarga\GraphQL\Resolver;
use Descarga\Subscriber\Input\SubscriberListFiltersInput;
use Descarga\Subscriber\SubscriberRepositoryInterface;
use Descarga\Subscriber\UseCase\SubscriberList;
use Predis\Client as CacheService;

class SubscriberListResolver implements Resolver
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberList $subscriberList,
        protected CacheService $cacheService
    ) {
    }

    public function resolve($rootValue, array $args, Context $context): array
    {
        $input = SubscriberListFiltersInput::createFromArray([
            'page' => $args['input']['page'] ?? 1,
            'limit' => $args['input']['limit'] ?? 10,
        ]);

        $cacheResult = $this->cacheService->get(serialize($input));
        if ($cacheResult) {
            return json_decode($cacheResult, true);
        }

        $result = (array) $this->subscriberList->handler($input);
        $this->cacheService->set(serialize($input), json_encode($result));

        return $result;
    }
}
