<?php

declare(strict_types=1);

namespace Descarga\Rest\Action\Subscriber;

use Descarga\Subscriber\Input\SubscriberListFiltersInput;
use Descarga\Subscriber\UseCase\SubscriberList;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/subscribers",
 *     summary="Subscriber List",
 *     tags={"Subscriber"},
 *     @OA\Response(
 *         response=200,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriberListOutput"),
 *     )
 * )
 */
class SubscriberListAction
{
    public function __construct(
        protected SubscriberList $subscriberList
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $input = SubscriberListFiltersInput::createFromArray([
            'page' => $request->query->getInt('page', 1),
            'limit' => $request->query->getInt('limit', 10),
        ]);

        $output = $this->subscriberList->handler($input);

        return new JsonResponse(json_encode($output));
    }
}
