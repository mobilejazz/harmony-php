<?php

namespace Sample\Product\Data\Sql;

use Harmony\Core\Module\Sql\Schema\SqlSchemaInterface;

class ProductSqlSchemaInterface implements SqlSchemaInterface {
  public function getTableName(): string {
    return "products";
  }

  public function getIdColumn(): string {
    return "id";
  }

  public function softDeleteEnabled(): bool {
    return false;
  }
}
