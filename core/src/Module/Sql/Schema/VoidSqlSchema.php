<?php

namespace Harmony\Core\Module\Sql\Schema;

use Harmony\Core\Error\MethodNotImplementedException;

class VoidSqlSchema implements SqlSchemaInterface {
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
  public function softDeleteEnabled(): bool {
    throw new MethodNotImplementedException();
  }
}
