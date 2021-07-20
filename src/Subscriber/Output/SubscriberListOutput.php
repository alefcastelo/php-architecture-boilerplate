<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Output;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema
 */
class SubscriberListOutput
{
    /**
     * @OA\Property(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/SubscriberPartialOutput"),
     * )
     */
    public array $items;
}
