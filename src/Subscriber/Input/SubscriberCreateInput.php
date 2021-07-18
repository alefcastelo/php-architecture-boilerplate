<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Input;

class SubscriberCreateInput
{
    public mixed $firstName;

    public mixed $lastName;

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