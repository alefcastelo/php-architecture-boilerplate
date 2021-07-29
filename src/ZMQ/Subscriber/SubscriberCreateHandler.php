<?php

declare(strict_types=1);

namespace Descarga\ZMQ\Subscriber;

use Descarga\Subscriber\Input\SubscriberCreateInput;
use Descarga\Subscriber\Output\SubscriberFullOutput;
use Descarga\Subscriber\UseCase\SubscriberCreate;

class SubscriberCreateHandler
{
    public function __construct(
        protected SubscriberCreate $subscriberCreate
    ) {
    }

    public function __invoke(array $data): SubscriberFullOutput
    {
        $input = SubscriberCreateInput::createFromArray($data);

        return $this->subscriberCreate->handler($input);
    }
}
