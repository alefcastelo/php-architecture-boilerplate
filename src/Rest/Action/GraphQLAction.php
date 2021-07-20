<?php

declare(strict_types=1);

namespace Descarga\Rest\Action;

use Descarga\GraphQL\Context;
use Descarga\GraphQL\RootValue;
use GraphQL\Error\Error;
use GraphQL\Error\FormattedError;
use GraphQL\GraphQL;
use GraphQL\Utils\BuildSchema;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/graphql",
 *     summary="Subscriber Create",
 *     tags={"GraphQL"},
 *     @OA\RequestBody(
 *         description="Input graphql query format"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ok"
 *     )
 * )
 */
class GraphQLAction
{
    protected RootValue $rootValue;

    protected Context $context;

    protected string $graphqlSchemaPath;

    public function __construct(
        RootValue $rootValue,
        Context $context,
        string $graphqlSchemaPath
    ) {
        $this->graphqlSchemaPath = $graphqlSchemaPath;
        $this->rootValue = $rootValue;
        $this->context = $context;
    }

    public function __invoke(Request $request): Response
    {
        $httpStatusCode = Response::HTTP_OK;
        $data = json_decode($request->getContent(), true);
        $schema = BuildSchema::build(file_get_contents($this->graphqlSchemaPath));

        $errorFormatter = function (Error $error) {
            return FormattedError::createFromException($error);
        };

        $errorHandler = function (array $errors, callable $formatter) {
            return array_map($formatter, $errors);
        };

        $result = GraphQL::executeQuery(
            $schema,
            $data['query'],
            $this->rootValue->getRootValue(),
            $this->context,
            $data['variables'] ?? null,
            $data['operationName'] ?? null
        );

        $result->setErrorFormatter($errorFormatter);
        $result->setErrorsHandler($errorHandler);

        $output = $result->toArray();

        if (array_key_exists('errors', $output)) {
            $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return new JsonResponse($output, $httpStatusCode);
    }
}
