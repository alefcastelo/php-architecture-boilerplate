<?php

declare(strict_types=1);

namespace Descarga\gRPC\Subscriber;

use Descarga\gRPC\Generated\SubscriberCreateRequest;
use Descarga\gRPC\Generated\SubscriberOutputReply;
use Descarga\gRPC\Subscriber\Reply\SubscriberOutputReplyMapper;
use Descarga\Subscriber\Input\SubscriberCreateInput;
use Descarga\Subscriber\UseCase\SubscriberCreate;

class SubscriberCreateRPC
{
    public function __construct(
        protected SubscriberCreate $subscriberCreate,
        protected SubscriberOutputReplyMapper $outputReplyMapper
    ) {
    }

    public function __invoke(SubscriberCreateRequest $request): SubscriberOutputReply
    {
        $input = new SubscriberCreateInput(
            $request->getFirstName(),
            $request->getLastName(),
            $request->getEmail()
        );

        $output = $this->subscriberCreate->handler($input);

        return $this->outputReplyMapper->map($output);
    }
}
