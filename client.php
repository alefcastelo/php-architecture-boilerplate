<?php

declare(strict_types=1);

require dirname(__FILE__) . '/vendor/autoload.php';

$client = new \Descarga\gRPC\Generated\SubscriberClient('127.0.0.1:50051', [
    'credentials' => Grpc\ChannelCredentials::createInsecure(),
]);

$request = new \Descarga\gRPC\Generated\CreateSubscriberRequest();
$request->setFirstName('Alef');
$request->setLastName('Castelo');
$request->setEmail('alef@gmail.com');

[$response, $status] = $client->CreateSubscriber($request)->wait();

var_dump($response, $status);
