<?php

namespace Sample\User\Data\Query;

use Harmony\Core\Module\Sql\Query\OrderBySqlQuery;
use Harmony\Core\Module\Sql\Query\PaginationSqlQuery;
use Harmony\Core\Module\Sql\Query\WhereSqlQuery;
use Sample\User\Data\DataSource\Sql\UserSqlSchema;

class UserPaginationSqlQuery implements
  PaginationSqlQuery,
  WhereSqlQuery,
  OrderBySqlQuery {
  public function __construct(
    protected int $offset,
    protected int $limit,
    protected string $userName,
  ) {
  }

  public function offset(): int {
    return $this->offset;
  }

  public function limit(): int {
    return $this->limit;
  }

  /**
   * @return array<string, mixed>
   */
  public function where(): array {
    return [
      UserSqlSchema::COLUMN_NAME => $this->userName,
    ];
  }

  public function orderBy(): string {
    return UserSqlSchema::COLUMN_NAME;
  }

  public function ascending(): bool {
    return false;
  }
}
