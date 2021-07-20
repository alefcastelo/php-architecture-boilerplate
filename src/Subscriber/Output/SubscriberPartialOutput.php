<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Output;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema
 */
class SubscriberPartialOutput
{
    /**
     * @OA\Property(example="Alef")
     */
    public int $id;

    /**
     * @OA\Property(example="Alef")
     */
    public string $firstName;

    /**
     * @OA\Property(example="Castelo")
     */
    public string $lastName;
}
