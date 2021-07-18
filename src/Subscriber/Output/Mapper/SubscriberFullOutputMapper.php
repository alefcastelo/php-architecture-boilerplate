<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Output\Mapper;

use Descarga\Subscriber\Entity\Subscriber;
use Descarga\Subscriber\Output\SubscriberFullOutput;

class SubscriberFullOutputMapper
{
    public function map(Subscriber $subscriber): SubscriberFullOutput
    {
        $output = new SubscriberFullOutput();

        $output->id = $subscriber->getId();
        $output->firstName = $subscriber->getFirstName();
        $output->lastName = $subscriber->getLastName();
        $output->email = $subscriber->getEmail();

        return $output;
    }
}
