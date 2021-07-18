<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Input\Mapper;

use Descarga\Subscriber\Entity\Subscriber;
use Descarga\Subscriber\Input\SubscriberCreateInput;
use Descarga\Subscriber\Input\Validator\SubscriberCreateInputValidator;

class SubscriberCreateInputMapper
{
    public function __construct(
        protected SubscriberCreateInputValidator $subscriberCreateInputValidator
    ) {
    }

    public function map(SubscriberCreateInput $input): Subscriber
    {
        $this->subscriberCreateInputValidator->validate($input);

        return new Subscriber(
            $input->firstName,
            $input->lastName,
            $input->email
        );
    }
}
