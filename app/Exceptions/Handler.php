<?php

namespace App\Exceptions;

use App\Models\Traits\ResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

    public function register(): void
    {
        $this->renderable(function (\Throwable $th): JsonResponse {
            return $this->error(
                $th,
                $th->getMessage() ?? 'Ocorreu um erro inesperado no sistema!',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        });

        $this->renderable(function (DomainException $e): JsonResponse {
            if ($e->isError()) {
                return $this->error($e, $e->getCode(), $e->getMessage());
            }

            return $this->success([], $e->getMessage(), $e->getCode());
        });
    }
}
