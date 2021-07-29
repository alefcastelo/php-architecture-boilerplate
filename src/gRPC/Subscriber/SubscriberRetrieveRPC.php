<?php

declare(strict_types=1);

namespace Descarga\gRPC\Subscriber;

use Descarga\gRPC\Generated\SubscriberOutputReply;
use Descarga\gRPC\Generated\SubscriberRetrieveRequest;
use Descarga\gRPC\Subscriber\Reply\SubscriberOutputReplyMapper;
use Descarga\Subscriber\Output\Mapper\SubscriberFullOutputMapper;
use Descarga\Subscriber\SubscriberRepositoryInterface;

class SubscriberRetrieveRPC
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberFullOutputMapper $subscriberFullOutputMapper,
        protected SubscriberOutputReplyMapper $subscriberOutputReplyMapper
    ) {
    }

    public function __invoke(SubscriberRetrieveRequest $request): SubscriberOutputReply
    {
        $subscriber = $this->subscriberRepository->getById($request->getId());
        $output = $this->subscriberFullOutputMapper->map($subscriber);

        return $this->subscriberOutputReplyMapper->map($output);
    }
}
