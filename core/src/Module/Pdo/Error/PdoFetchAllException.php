<?php

namespace Harmony\Core\Module\Pdo\Error;

use Exception;

class PdoFetchAllException extends Exception {
  public function __construct() {
    parent::__construct("Error on Fetch All.");
  }
}
