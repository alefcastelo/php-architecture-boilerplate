<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Output\Mapper;

use Descarga\Subscriber\Entity\Subscriber;
use Descarga\Subscriber\Output\SubscriberPartialOutput;

class SubscriberPartialOutputMapper
{
    public function map(Subscriber $subscriber): SubscriberPartialOutput
    {
        $output = new SubscriberPartialOutput();

        $output->id = $subscriber->getId();
        $output->firstName = $subscriber->getFirstName();
        $output->lastName = $subscriber->getLastName();

        return $output;
    }
}
