<?php

namespace Harmony\Core\Domain\Exception;

class MethodNotImplementedException extends HarmonyException {
  public function __construct(
    string $message = "This method is not implemented yet.",
  ) {
    parent::__construct($message);
  }
}
