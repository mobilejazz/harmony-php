<?php

namespace Harmony\Core\Module\Pdo\Exception;

use Exception;

class PdoConnectionNotReadyException extends Exception {
  public function __construct() {
    parent::__construct("PDO Connection not ready.");
  }
}
