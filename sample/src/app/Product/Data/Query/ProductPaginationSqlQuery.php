<?php

namespace Sample\Product\Data\Query;

use Harmony\Core\Module\Sql\Query\OrderBySqlQuery;
use Harmony\Core\Module\Sql\Query\PaginationSqlQuery;
use Harmony\Core\Module\Sql\Query\WhereSqlQuery;
use Sample\Product\Data\DataSource\Sql\ProductSqlSchema;

class ProductPaginationSqlQuery implements
  PaginationSqlQuery,
  WhereSqlQuery,
  OrderBySqlQuery {
  public function __construct(
    protected int $offset,
    protected int $limit,
    protected string $productName,
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
      ProductSqlSchema::COLUMN_NAME => $this->productName,
    ];
  }

  public function orderBy(): string {
    return ProductSqlSchema::COLUMN_CREATED_AT;
  }

  public function ascending(): bool {
    return false;
  }
}
