<?php

declare(strict_types=1);

namespace Descarga\ZMQ\Subscriber;

use Descarga\Subscriber\Output\Mapper\SubscriberFullOutputMapper;
use Descarga\Subscriber\Output\SubscriberFullOutput;
use Descarga\Subscriber\SubscriberRepositoryInterface;
use InvalidArgumentException;

class SubscriberRetrieveHandler
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberFullOutputMapper $subscriberFullOutputMapper
    ) {
    }

    public function __invoke(array $data): SubscriberFullOutput
    {
        if (!isset($data['id'])) {
            throw new InvalidArgumentException('Id not found');
        }

        $subscriber = $this->subscriberRepository->getById($data['id']);

        return $this->subscriberFullOutputMapper->map($subscriber);
    }
}
