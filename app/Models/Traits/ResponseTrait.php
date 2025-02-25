<?php

namespace App\Models\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait ResponseTrait
{
    protected function success($data = [], string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        if (!in_array($code, SymfonyResponse::$statusTexts)) {
            $code = Response::HTTP_OK;
        }

        return response()->json(
            data: [
                'success' => true,
                'message' => $message,
                'data' => $data,
            ],
            status: $code,
            options: JSON_UNESCAPED_SLASHES
        );
    }

    protected function error(
        \Throwable $th,
        $message = null,
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse {
        if (!in_array($code, SymfonyResponse::$statusTexts)) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json(
            data: [
                'success' => false,
                'message' => $message ?? $th->getMessage(),
                'code' => $code,
            ],
            status: $code,
            options: JSON_UNESCAPED_SLASHES
        );
    }
}
