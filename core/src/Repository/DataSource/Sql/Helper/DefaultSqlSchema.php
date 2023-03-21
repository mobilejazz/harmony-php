<?php

namespace Harmony\Core\Repository\DataSource\Sql\Helper;

use Harmony\Core\Repository\DataSource\Sql\SqlBaseColumn;

abstract class DefaultSqlSchema implements SqlSchema {
  abstract public function getTableName(): string;

  public function getIdColumn(): string {
    return SqlBaseColumn::ID;
  }

  public function getKeyColumn(): string {
    return $this->getIdColumn();
  }

  public function softDeleteEnabled(): bool {
    return false;
  }
}
