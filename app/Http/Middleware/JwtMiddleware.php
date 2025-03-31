<?php

namespace App\Http\Middleware;

use App\Models\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    use ResponseTrait;

    public function handle(Request $request, Closure $next): JsonResponse
    {
        try {
            JWTAuth::parseToken()->authenticate();

            return $this->success(message: '');
        } catch (TokenInvalidException $e) {
            return $this->error($e, 'Token inválido!', Response::HTTP_UNAUTHORIZED);
        } catch (TokenExpiredException $e) {
            return $this->error($e, 'Token expirado!', Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return $this->error($e, 'Token não fornecido!', Response::HTTP_UNAUTHORIZED);
        }
    }
}
