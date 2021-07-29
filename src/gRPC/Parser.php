<?php

declare(strict_types=1);

namespace Descarga\gRPC;

class Parser
{
    public const GRPC_ERROR_NO_RESPONSE = -1;

    public static function pack(string $data): string
    {
        return $data = pack('CN', 0, strlen($data)) . $data;
    }

    public static function unpack(string $data): string
    {
        return $data = substr($data, 5);
    }

    public static function serializeMessage($data)
    {
        if (method_exists($data, 'encode')) {
            $data = $data->encode();
        } elseif (method_exists($data, 'serializeToString')) {
            $data = $data->serializeToString();
        } elseif (method_exists($data, 'serialize')) {
            $data = $data->serialize();
        }

        return self::pack((string) $data);
    }

    public static function deserializeMessage($deserialize, string $value)
    {
        if (empty($value)) {
            return null;
        }
        $value = self::unpack($value);

        if (is_array($deserialize)) {
            [$className, $deserializeFunc] = $deserialize;
            /** @var \Google\Protobuf\Internal\Message $object */
            $object = new $className();
            if ($deserializeFunc && method_exists($object, $deserializeFunc)) {
                $object->{$deserializeFunc}($value);
            } else {
                $object->mergeFromString($value);
            }

            return $object;
        }

        return call_user_func($deserialize, $value);
    }

    public static function parseResponse($response, $deserialize): array
    {
        if (!$response) {
            return ['No response', self::GRPC_ERROR_NO_RESPONSE, $response];
        }
        if (self::isinvalidStatus($response->statusCode)) {
            $message = $response->headers['grpc-message'] ?? 'Http status Error';
            $code = $response->headers['grpc-status'] ?? ($response->errCode ?: $response->statusCode);

            return [$message, (int) $code, $response];
        }
        $grpcStatus = (int) ($response->headers['grpc-status'] ?? 0);
        if (0 !== $grpcStatus) {
            return [$response->headers['grpc-message'] ?? 'Unknown error', $grpcStatus, $response];
        }
        $data = $response->data;
        $reply = self::deserializeMessage($deserialize, $data);
        $status = (int) ($response->headers['grpc-status'] ?? 0 ?: 0);

        return [$reply, $status, $response];
    }

    private static function isInvalidStatus(int $code)
    {
        return 0 !== $code && 200 !== $code && 400 !== $code;
    }
}
