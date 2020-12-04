<?php

namespace harmony\core\shared\error;

use InvalidArgumentException;
use Throwable;

class InvalidObjectException extends InvalidArgumentException
{
    /**
     * @param string         $expected
     * @param string         $received
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $expected,
        string $received,
        string $message = '',
        int $code = 0,
        Throwable $previous = null
    ) {
        if (empty($message)) {
            $message = "Error: Expected object instanceof '" . $expected . "'"
                . ", received '" . $received . "'.";
        }

        parent::__construct($message, $code, $previous);
    }
}
