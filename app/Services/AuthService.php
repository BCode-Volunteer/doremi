<?php

namespace App\Services;

use App\Exceptions\AuthException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthService implements IAuthService
{
    public function login(array $credentials): string
    {
        if (!($token = Auth::attempt($credentials))) {
            throw new AuthException('Email e/ou senha inválidos.', Response::HTTP_UNAUTHORIZED);
        }
        
        return $token;
    }
}
