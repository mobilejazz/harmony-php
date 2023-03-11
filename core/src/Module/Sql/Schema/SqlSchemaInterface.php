<?php

namespace Harmony\Core\Module\Sql\Schema;

interface SqlSchemaInterface {
  public function getTableName(): string;

  public function getIdColumn(): string;

  public function softDeleteEnabled(): bool;
}
