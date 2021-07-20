<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Input;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     required={"firstName", "lastName", "email"},
 * )
 */
class SubscriberCreateInput
{
    /**
     * @OA\Property(example="Alef")
     */
    public mixed $firstName;

    /**
     * @OA\Property(example="Castelo")
     */
    public mixed $lastName;

    /**
     * @OA\Property(example="alefaraujocastelo@gmail.com")
     */
    public mixed $email;

    public function __construct(
        mixed $firstName,
        mixed $lastName,
        mixed $email
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public static function createFromArray(array $data = []): self
    {
        return new self(
            $data['firstName'] ?? null,
            $data['lastName'] ?? null,
            $data['email'] ?? null
        );
    }
}
