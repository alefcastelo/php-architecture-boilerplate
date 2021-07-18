<?php

declare(strict_types=1);

namespace Descarga\Subscriber;

use Descarga\Subscriber\Entity\Subscriber;
use Descarga\Subscriber\Input\SubscriberListFiltersInput;

interface SubscriberRepositoryInterface
{
    public function getById(int $id): Subscriber;

    public function create(Subscriber $subscriber): void;

    public function update(Subscriber $subscriber): void;

    public function list(SubscriberListFiltersInput $filters): array;
}
