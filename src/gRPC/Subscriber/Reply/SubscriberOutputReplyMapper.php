<?php

declare(strict_types=1);

namespace Descarga\gRPC\Subscriber\Reply;

use Descarga\gRPC\Generated\SubscriberOutputReply;
use Descarga\Subscriber\Output\SubscriberFullOutput;

class SubscriberOutputReplyMapper
{
    public function map(SubscriberFullOutput $output): SubscriberOutputReply
    {
        $reply = new SubscriberOutputReply();
        $reply->setId($output->id);
        $reply->setFirstName($output->firstName);
        $reply->setLastName($output->lastName);
        $reply->setEmail($output->email);

        return $reply;
    }
}
