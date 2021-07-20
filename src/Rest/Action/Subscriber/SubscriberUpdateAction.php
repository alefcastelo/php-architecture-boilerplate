<?php

declare(strict_types=1);

namespace Descarga\Rest\Action\Subscriber;

use Descarga\Subscriber\Input\SubscriberUpdateInput;
use Descarga\Subscriber\UseCase\SubscriberUpdate;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Put(
 *     path="/subscribers/{id}",
 *     summary="Subscriber Update",
 *     tags={"Subscriber"},
 *     @OA\RequestBody(
 *         description="Input data format",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriberUpdateInput"),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriberFullOutput"),
 *     )
 * )
 */
class SubscriberUpdateAction
{
    public function __construct(
        protected SubscriberUpdate $subscriberUpdate
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->attributes->getInt('id');
        $data = json_decode($request->getContent(), true);
        $input = SubscriberUpdateInput::createFromArray($data);
        $output = $this->subscriberUpdate->handler($id, $input);

        return new JsonResponse(json_encode($output));
    }
}
