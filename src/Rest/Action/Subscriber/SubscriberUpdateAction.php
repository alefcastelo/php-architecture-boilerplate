<?php

declare(strict_types=1);

namespace Descarga\Rest\Action\Subscriber;

use Descarga\Subscriber\Input\SubscriberUpdateInput;
use Descarga\Subscriber\UseCase\SubscriberUpdate;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
