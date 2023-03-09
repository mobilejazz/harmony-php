<?php

namespace Harmony\Core\Repository\DataSource\Sql\Queries;

class PatchUserSqlQuery implements PatchSqlQuery {
  public function __construct(
    private readonly int $userId,
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

  public function where(): array {
    return [
      (new UserSqlSchema())->getIdColumn() => $this->userId,
    ];
  }
}
