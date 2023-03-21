<?php

namespace Harmony\Core\Module\Sql\Schema;

interface SqlSchema {
  public function getTableName(): string;

  public function getIdColumn(): string;

  public function softDeleteEnabled(): bool;
}
