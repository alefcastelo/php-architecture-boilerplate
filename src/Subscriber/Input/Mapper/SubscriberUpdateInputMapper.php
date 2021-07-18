<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Input\Mapper;

use Descarga\Subscriber\Entity\Subscriber;
use Descarga\Subscriber\Input\SubscriberUpdateInput;
use Descarga\Subscriber\Input\Validator\SubscriberUpdateInputValidator;
use Descarga\Subscriber\SubscriberRepositoryInterface;

class SubscriberUpdateInputMapper
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberUpdateInputValidator $subscriberUpdateInputValidator
    ) {
    }

    public function map(int $id, SubscriberUpdateInput $input): Subscriber
    {
        $this->subscriberUpdateInputValidator->validate($input);

        $subscriber = $this->subscriberRepository->getById($id);
        $subscriber->setFirstName($input->firstName);
        $subscriber->setLastName($input->lastName);

        return $subscriber;
    }
}
