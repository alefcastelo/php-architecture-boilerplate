<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Input;

class SubscriberListFiltersInput
{
    public mixed $page;

    public mixed $limit;

    public function __construct(
        mixed $page,
        mixed $limit
    ) {
        $this->page = $page;
        $this->limit = $limit;
    }

    public static function createFromArray(array $query = []): self
    {
        return new self(
            $query['page'] ?? 1,
            $query['limit'] ?? 10
        );
    }
}
