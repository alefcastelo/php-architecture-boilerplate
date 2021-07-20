<?php

declare(strict_types=1);

namespace Descarga\Rest\Action\Subscriber;

use Descarga\Subscriber\Input\SubscriberCreateInput;
use Descarga\Subscriber\UseCase\SubscriberCreate;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/subscribers",
 *     summary="Subscriber Create",
 *     tags={"Subscriber"},
 *     @OA\RequestBody(
 *         description="Input data format",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriberCreateInput"),
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriberFullOutput"),
 *     )
 * )
 */
class SubscriberCreateAction
{
    public function __construct(
        protected SubscriberCreate $subscriberCreate
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $input = SubscriberCreateInput::createFromArray($data);
        $output = $this->subscriberCreate->handler($input);

        return new JsonResponse(json_encode($output));
    }
}
