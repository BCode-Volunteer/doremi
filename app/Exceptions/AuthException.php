<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class AuthException extends DomainException
{
    public function __construct(
        string $message = 'Ocorreu um erro ao processar autenticação!',
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        \Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
