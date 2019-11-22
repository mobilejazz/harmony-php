<?php

namespace harmony\core\shared\error;

use InvalidArgumentException as PHPInvalidArgumentException;
use Throwable;

class InvalidArgumentException extends PHPInvalidArgumentException
{
    /**
     * @param string         $expected
     * @param string         $getted
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $expected,
        string $getted,
        $message = '',
        $code = 0,
        Throwable $previous = null
    ) {
        if (empty($message)) {
            $message = "Error: Expected object instanceof '" . $expected . "'"
                . ", getted '" . $getted . "'.";
        }

        parent::__construct($message, $code, $previous);
    }
}
