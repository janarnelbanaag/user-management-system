<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiService
{
    public static function response($message, $data = [], $statusCode = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
