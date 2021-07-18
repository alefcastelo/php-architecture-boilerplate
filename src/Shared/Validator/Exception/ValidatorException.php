<?php

declare(strict_types=1);

namespace Descarga\Shared\Validator\Exception;

use Descarga\Shared\Exception\ResponseException;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ValidatorException extends RuntimeException implements ResponseException
{
    public function __construct(
        $message = '',
        protected array $errors = [],
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getResponseException(): Response
    {
        return new JsonResponse($this->errors);
    }
}
