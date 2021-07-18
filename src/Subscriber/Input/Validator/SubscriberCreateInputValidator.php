<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Input\Validator;

use Descarga\Shared\Validator\Exception\ValidatorException;
use Descarga\Subscriber\Input\SubscriberCreateInput;

class SubscriberCreateInputValidator
{
    public function validate(SubscriberCreateInput $input): bool
    {
        $errors = [];

        if (!is_string($input->firstName)) {
            $errors['firstName'] = 'is_required';
        }

        if (!is_string($input->lastName)) {
            $errors['lastName'] = 'is_required';
        }

        if (!is_string($input->email)) {
            $errors['email'] = 'is_required';
        }

        if ($errors) {
            throw new ValidatorException('Invalid input.', $errors);
        }

        return true;
    }
}
