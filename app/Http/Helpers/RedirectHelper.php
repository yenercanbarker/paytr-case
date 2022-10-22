<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;

class RedirectHelper
{
    /**
     * Redirect Success
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function success(array $data = [], string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Redirect Store
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function store(array $data = [], string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return self::success($data, 'Created successfully.', $statusCode);
    }

    /**
     * Redirect Update
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function update(array $data = [], string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return self::success($data, 'Updated successfully.', $statusCode);
    }

    /**
     * Redirect Delete
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function delete(array $data = [], string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return self::success($data, 'Deleted successfully.', $statusCode);
    }

    /**
     * Redirect Error
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function error(array $data = [], string $message = 'Error', int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Redirect Custom Success
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function customSuccess(array $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => 'Success',
            'data' => $data
        ], $statusCode);
    }

    /**
     * Redirect Permission Denied
     * @return JsonResponse
     */
    public static function permissionDenied(): JsonResponse
    {
        return response()->json([
            'status_code' => 403,
            'message' => 'Permission Denied'
        ], 403);
    }
}