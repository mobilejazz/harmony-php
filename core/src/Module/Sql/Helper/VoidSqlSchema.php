<?php

namespace Harmony\Core\Module\Sql\Helper;

use Harmony\Core\Shared\Error\MethodNotImplementedException;

class VoidSqlSchema implements SqlSchema {
  /**
   * @throws MethodNotImplementedException
   */
  public function getTableName(): string {
    throw new MethodNotImplementedException();
  }

  /**
   * @throws MethodNotImplementedException
   */
  public function getIdColumn(): string {
    throw new MethodNotImplementedException();
  }

  /**
   * @throws MethodNotImplementedException
   */
  public function getKeyColumn(): string {
    throw new MethodNotImplementedException();
  }
}
