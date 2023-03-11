<?php

namespace Harmony\Core\Data\Error;

use Exception;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Error\HarmonyException;
use Throwable;

class QueryNotSupportedException extends Exception implements HarmonyException {
  public function __construct(
    Query $queryNotSupported,
    string $message = null,
    int $code = 0,
    Throwable $previous = null,
  ) {
    $message ??= "Query not supported: " . $queryNotSupported::class;

    parent::__construct($message, $code, $previous);
  }
}
