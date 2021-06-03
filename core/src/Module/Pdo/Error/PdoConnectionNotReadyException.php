<?php

namespace harmony\core\Module\Pdo\Error;

use Exception;

class PdoConnectionNotReadyException extends Exception {
  public function __construct() {
    parent::__construct("PDO Connection not ready.");
  }
}
