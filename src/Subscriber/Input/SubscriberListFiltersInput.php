<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Input;

class SubscriberListFiltersInput
{
    public mixed $page = 1;

    public mixed $limit = 10;

    public function __construct(
        mixed $page,
        mixed $limit
    ) {
        $this->page = $page;
        $this->limit = $limit;
    }

    public function createFromArray(array $query = []): self
    {
        return new self(
            $query['page'] ?? 1,
            $query['limit'] ?? 10
        );
    }
}
