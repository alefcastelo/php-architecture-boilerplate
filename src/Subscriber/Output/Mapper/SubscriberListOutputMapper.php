<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Output\Mapper;

use Descarga\Subscriber\Output\SubscriberListOutput;

class SubscriberListOutputMapper
{
    public function __construct(
        protected SubscriberPartialOutputMapper $subscriberPartialOutputMapper
    ) {
    }

    public function map(array $subscribers): SubscriberListOutput
    {
        $output = new SubscriberListOutput();
        $output->items = array_map(
            fn ($subscriber) => $this->subscriberPartialOutputMapper->map($subscriber),
            $subscribers
        );

        return $output;
    }
}
