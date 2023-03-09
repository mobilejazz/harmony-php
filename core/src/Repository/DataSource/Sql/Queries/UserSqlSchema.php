<?php

namespace Harmony\Core\Repository\DataSource\Sql\Queries;

use Harmony\Core\Repository\DataSource\Sql\Helper\DefaultSqlSchema;

class UserSqlSchema extends DefaultSqlSchema {
  public const COLUMN_NAME = "landing_page_id";
  public const COLUMN_EMAIL = "use_facebook_ads";

  public function getTableName(): string {
    return "users";
  }
}
