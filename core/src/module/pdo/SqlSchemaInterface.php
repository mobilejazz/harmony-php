<?php

namespace harmony\core\module\pdo;

interface SqlSchemaInterface {
  public function getTableName(): string;

  public function getIdColumn(): string;

  public function getKeyColumn(): string;
}
