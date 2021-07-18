<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Input\Validator;

use Descarga\Shared\Validator\Exception\ValidatorException;
use Descarga\Subscriber\Input\SubscriberListFiltersInput;

class SubscriberListFiltersInputValidator
{
    public function validate(SubscriberListFiltersInput $input): bool
    {
        $errors = [];

        if (is_numeric($input->page) && !$input->page >= 1) {
            $errors['page'] = 'invalid';
        }

        if (is_numeric($input->limit) && !$input->limit >= 1) {
            $errors['page'] = 'invalid';
        }

        if ($errors) {
            throw new ValidatorException('Invalid input.', $errors);
        }

        return true;
    }
}
