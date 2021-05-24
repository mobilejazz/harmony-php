<?php

namespace harmony\core\module\pdo;

class PdoConfigDataSource {
  public function __construct(
    protected string $tableName,
    protected string $idColumn,
    protected string $keyColumn
  ) {

  }

  public function getTableName(): string {
    return $this->tableName;
  }

  public function getIdColumn(): string {
    return $this->idColumn;
  }

  public function getKeyColumn(): string {
    return $this->keyColumn;
  }
}
