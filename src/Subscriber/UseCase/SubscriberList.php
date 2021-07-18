<?php

declare(strict_types=1);

namespace Descarga\Subscriber\UseCase;

use Descarga\Subscriber\Input\SubscriberListFiltersInput;
use Descarga\Subscriber\Input\Validator\SubscriberListFiltersInputValidator;
use Descarga\Subscriber\Output\Mapper\SubscriberListOutputMapper;
use Descarga\Subscriber\Output\SubscriberListOutput;
use Descarga\Subscriber\SubscriberRepositoryInterface;

class SubscriberList
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberListFiltersInputValidator $subscriberListFiltersInputValidator,
        protected SubscriberListOutputMapper $subscriberListOutputMapper
    ) {
    }

    public function handler(SubscriberListFiltersInput $input): SubscriberListOutput
    {
        $this->subscriberListFiltersInputValidator->validate($input);

        $subscribers = $this->subscriberRepository->list($input);

        return $this->subscriberListOutputMapper->map($subscribers);
    }
}
