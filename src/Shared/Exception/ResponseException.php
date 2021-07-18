<?php

declare(strict_types=1);

namespace Descarga\Shared\Exception;

use Symfony\Component\HttpFoundation\Response;

interface ResponseException
{
    public function getResponseException(): Response;
}
