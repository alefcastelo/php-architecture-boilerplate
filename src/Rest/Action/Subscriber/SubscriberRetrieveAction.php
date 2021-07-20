<?php

declare(strict_types=1);

namespace Descarga\Rest\Action\Subscriber;

use Descarga\Subscriber\Output\Mapper\SubscriberFullOutputMapper;
use Descarga\Subscriber\SubscriberRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/subscribers/{id}",
 *     summary="Subscriber Retrieve",
 *     tags={"Subscriber"},
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(ref="#/components/schemas/SubscriberFullOutput"),
 *     )
 * )
 */
class SubscriberRetrieveAction
{
    public function __construct(
        protected SubscriberRepositoryInterface $subscriberRepository,
        protected SubscriberFullOutputMapper $subscriberFullOutputMapper
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->attributes->getInt('id');
        $subscriber = $this->subscriberRepository->getById($id);
        $output = $this->subscriberFullOutputMapper->map($subscriber);

        return new JsonResponse(json_encode($output));
    }
}
