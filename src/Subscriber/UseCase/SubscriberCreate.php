<?php

declare(strict_types=1);

namespace Descarga\Subscriber\UseCase;

use Descarga\Subscriber\Input\Mapper\SubscriberCreateInputMapper;
use Descarga\Subscriber\Input\SubscriberCreateInput;
use Descarga\Subscriber\Output\Mapper\SubscriberFullOutputMapper;
use Descarga\Subscriber\Output\SubscriberFullOutput;
use Descarga\Subscriber\SubscriberRepositoryInterface;

class SubscriberCreate
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberCreateInputMapper $subscriberCreateInputMapper,
        protected SubscriberFullOutputMapper $subscriberFullOutputMapper
    ) {
    }

    public function handler(SubscriberCreateInput $input): SubscriberFullOutput
    {
        $subscriber = $this->subscriberCreateInputMapper->map($input);
        $subscriber = $this->subscriberRepository->create($subscriber);

        return $this->subscriberFullOutputMapper->map($subscriber);
    }
}
