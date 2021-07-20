<?php

declare(strict_types=1);

namespace Descarga\Rest\Action;

use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/",
 *     summary="Subscriber Create",
 *     tags={"App"},
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *     ),
 * ),
 */
class HealthCheckAction
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'Ok', 'time' => time()]);
    }
}
