<?php

declare(strict_types=1);

namespace Descarga\Rest\Action;

use Symfony\Component\HttpFoundation\JsonResponse;

class HealthCheckAction
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'Ok', 'time' => time()]);
    }
}
