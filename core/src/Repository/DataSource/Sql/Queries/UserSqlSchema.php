<?php

namespace Harmony\Core\Repository\DataSource\Sql\Queries;

use Harmony\Core\Repository\DataSource\Sql\Helper\DefaultSqlSchema;

class UserSqlSchema extends DefaultSqlSchema {
  public const COLUMN_NAME = "name";
  public const COLUMN_EMAIL = "email";

  public function getTableName(): string {
    return "users";
  }
}
