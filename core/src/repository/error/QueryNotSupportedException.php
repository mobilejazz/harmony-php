<?php

namespace harmony\core\repository\error;

use Exception;
use Throwable;

class QueryNotSupportedException extends Exception
{
    public function __construct(
        string $message = 'Query not supported',
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
