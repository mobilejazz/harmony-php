<?php

namespace Sample\User\Data\DataSource\Sql;

/**
 * @psalm-immutable
 */
class UserSqlData {
  public function __construct(
    public ?int $id = null,
    public ?string $name = null,
    public ?string $email = null,
  ) {
  }
}
