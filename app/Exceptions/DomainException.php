<?php

namespace App\Exceptions;

use Exception;

class DomainException extends Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        \Throwable $previous = null,
        private ?bool $error = true
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function isError(): bool
    {
        return $this->error;
    }
}
