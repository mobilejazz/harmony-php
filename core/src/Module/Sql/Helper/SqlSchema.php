<?php

namespace harmony\core\Module\Sql\Helper;

interface SqlSchema {
  public function getTableName(): string;

  public function getIdColumn(): string;

  public function getKeyColumn(): string;
}
