<?php

namespace Harmony\Core\Module\Pdo\Error;

use Exception;

class PdoFetchException extends Exception {
  public function __construct() {
    parent::__construct("Error on Fetch.");
  }
}
