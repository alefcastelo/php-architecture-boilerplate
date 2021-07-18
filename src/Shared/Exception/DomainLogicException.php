<?php

declare(strict_types=1);

namespace Descarga\Shared\Exception;

use LogicException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DomainLogicException extends LogicException implements ResponseException
{
    public function getResponseException(): Response
    {
        return new JsonResponse([
            'message' => $this->message,
        ], Response::HTTP_BAD_REQUEST);
    }
}
