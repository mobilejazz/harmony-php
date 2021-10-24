<?php

namespace Sample\User\Data\DataSource\Sql;

use Harmony\Core\Domain\Exception\MethodNotImplementedException;
use Harmony\Core\Module\Sql\Helper\SqlSchema;
use Sample\System\Data\DataSource\SampleSqlSchema;

class UserSqlSchema implements SqlSchema {
  public const TABLE_NAME = "user";

  public const COLUMN_ID = SampleSqlSchema::DEFAULT_COLUMN_ID;
  public const COLUMN_NAME = "name";
  public const COLUMN_EMAIL = "email";

  public function getTableName(): string {
    return self::TABLE_NAME;
  }

  public function getIdColumn(): string {
    return self::COLUMN_ID;
  }

  public function getKeyColumn(): string {
    throw new MethodNotImplementedException();
  }
}
