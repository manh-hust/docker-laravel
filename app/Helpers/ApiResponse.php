<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    public static function createSuccessResponse($data)
    {
        return new JsonResponse([
            'success' => true,
            'message' =>  'SUCCESS',
            'data' =>  $data
        ], 200);
    }

    public static function createPaginatedResponse($data, $total, $perPage, $page)
    {
        return new JsonResponse([
            'success' => true,
            'message' =>  'SUCCESS',
            'data' =>  $data,
            'pagination' => [
                'total' => $total,
                'per_page' => $perPage,
                'page' => $page
            ]
        ], 200);
    }

    public static function createFailedResponse($error, $code = 400, $message = 'FAILED')
    {
        return new JsonResponse([
            'success' => false,
            'message' =>  $message,
            'errors' =>  $error
        ], $code);
    }

    public static function createInvalidResponse($error)
    {
        return self::createFailedResponse($error, 422, 'INVALID');
    }

    public static function createNotFoundResponse($error)
    {
        return self::createFailedResponse($error, 404, 'NOT FOUND');
    }

    public static function createUnauthorizedResponse($error)
    {
        return self::createFailedResponse($error, 401, 'UNAUTHORIZED');
    }

    public static function createForbiddenResponse($error)
    {
        return self::createFailedResponse($error, 403, 'FORBIDDEN');
    }

    public static function createBadRequestResponse($error)
    {
        return self::createFailedResponse($error, 400, 'BAD REQUEST');
    }

    public static function createInternalServerErrorResponse($error)
    {
        return self::createFailedResponse($error, 500, 'INTERNAL SERVER ERROR');
    }
}