<?php

declare(strict_types=1);

echo 'Connecting to hello world server...' . PHP_EOL;

$requester = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ);
$requester->connect('tcp://localhost:5555');

$event = new StdClass();
$event->namespace = 'Subscriber';
$event->action = 'SubscriberCreateHandler';
$event->payload = json_encode([
    'firstName' => 'Alef',
    'lastName' => 'ZMQ Server',
    'email' => 'alef@zmq.com',
]);

$reply = json_decode($requester->send(json_encode($event))->recv());

var_dump($reply);

$event = new StdClass();
$event->namespace = 'Subscriber';
$event->action = 'SubscriberRetrieveHandler';
$event->payload = json_encode(['id' => $reply->id]);

var_dump(json_decode($requester->send(json_encode($event))->recv()));
