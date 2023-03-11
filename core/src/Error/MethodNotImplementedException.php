<?php

namespace Harmony\Core\Error;

use Exception;
use Throwable;

class MethodNotImplementedException extends Exception implements
  HarmonyException {
  public function __construct(
    string $message = "This method is not implemented yet.",
    int $code = 0,
    Throwable $previous = null,
  ) {
    parent::__construct($message, $code, $previous);
  }
}
