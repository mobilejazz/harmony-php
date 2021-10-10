<?php

namespace Harmony\Core\Shared\Error;

class MethodNotImplementedException extends HarmonyException {
  public function __construct(
    string $message = "This method is not implemented yet.",
  ) {
    parent::__construct($message);
  }
}
