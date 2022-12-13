<?php

namespace Harmony\Core\Repository\DataSource\Sql\Helper;

use Harmony\Core\Domain\Exception\MethodNotImplementedException;

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

  /**
   * @throws MethodNotImplementedException
   */
  public function softDeleteEnabled(): bool {
    throw new MethodNotImplementedException();
  }

  /**
   * @throws MethodNotImplementedException
   */
  public function getReturnClass(): ?string {
    throw new MethodNotImplementedException();
  }
}
