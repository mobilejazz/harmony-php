<?php

namespace harmony\core\shared\error;

use Exception;
use Throwable;

class MethodNotImplementedException extends Exception
{
    public function __construct(
        $message = 'This method is not implemented yet.',
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
