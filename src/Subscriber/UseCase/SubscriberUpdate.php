<?php

declare(strict_types=1);

namespace Descarga\Subscriber\UseCase;

use Descarga\Subscriber\Input\Mapper\SubscriberUpdateInputMapper;
use Descarga\Subscriber\Input\SubscriberUpdateInput;
use Descarga\Subscriber\Output\Mapper\SubscriberFullOutputMapper;
use Descarga\Subscriber\Output\SubscriberFullOutput;
use Descarga\Subscriber\SubscriberRepositoryInterface;

class SubscriberUpdate
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberUpdateInputMapper $subscriberUpdateInputMapper,
        protected SubscriberFullOutputMapper $subscriberFullOutputMapper
    ) {
    }

    public function handler(int $id, SubscriberUpdateInput $input): SubscriberFullOutput
    {
        $subscriber = $this->subscriberUpdateInputMapper->map($id, $input);
        $this->subscriberRepository->update($subscriber);

        return $this->subscriberFullOutputMapper->map($subscriber);
    }
}
