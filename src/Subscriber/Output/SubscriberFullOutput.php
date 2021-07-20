<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Output;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema
 */
class SubscriberFullOutput
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

    /**
     * @OA\Property(example="alefaraujocastelo@gmail.com")
     */
    public string $email;
}
