<?php

declare(strict_types=1);

namespace Descarga\Subscriber;

use Descarga\Subscriber\Entity\Subscriber;

interface SubscriberRepositoryInterface
{
    public function getById(int $id): Subscriber;

    public function create(Subscriber $subscriber): Subscriber;

    public function update(Subscriber $subscriber): Subscriber;

    public function list(Subscriber $subscriber): Subscriber;
}
