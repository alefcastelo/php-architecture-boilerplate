<?php

declare(strict_types=1);

namespace Descarga\Rest\Action\Subscriber;

use Descarga\Subscriber\Input\SubscriberCreateInput;
use Descarga\Subscriber\UseCase\SubscriberCreate;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
