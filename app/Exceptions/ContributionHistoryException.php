<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ContributionHistoryException extends DomainException
{
    public function __construct(
        string $message = 'Ocorreu um erro ao processar a histórico de contribuições!',
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        \Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
