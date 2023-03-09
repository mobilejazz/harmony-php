<?php

namespace Harmony\Core\Repository\DataSource\Sql\Queries;

class InsertUserSqlQuery implements InsertSqlQuery {
  public function __construct(
    private readonly string $name,
    private readonly string $email,
  ) {
  }

  public function getValues(): array {
    return [
      UserSqlSchema::COLUMN_EMAIL => $this->name,
      UserSqlSchema::COLUMN_NAME => $this->email,
    ];
  }
}
