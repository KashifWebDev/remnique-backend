<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait APIResponseTrait{
    public function successResponse($message, $data = [], $status = 200): JsonResponse{
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }
    public function errorResponse($message, $data = [], $status = 422): JsonResponse{
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $status);
    }

}
