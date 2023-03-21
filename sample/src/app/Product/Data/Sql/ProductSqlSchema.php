<?php

namespace Sample\Product\Data\Sql;

use Harmony\Core\Repository\DataSource\Sql\Helper\SqlSchema;

class ProductSqlSchema implements SqlSchema {
  public const TABLE_NAME = "products";

  public const COLUMN_ID = "id";
  public const COLUMN_NAME = "name";
  public const COLUMN_DESCRIPTION = "description";
  public const COLUMN_PRICE = "price";

  public const COLUMN_CREATED_AT = "created_at";

  public function getTableName(): string {
    return self::TABLE_NAME;
  }

  public function getIdColumn(): string {
    return self::COLUMN_ID;
  }

  public function getKeyColumn(): string {
    return $this->getIdColumn();
  }

  public function softDeleteEnabled(): bool {
    return false;
  }
}
