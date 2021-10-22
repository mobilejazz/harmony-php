<?php

namespace Sample\Product\Data\DataSource\Sql;

use Harmony\Core\Domain\Exception\MethodNotImplementedException;
use Harmony\Core\Module\Sql\Helper\SqlSchema;
use Sample\System\Data\DataSource\SampleSqlSchema;

class ProductSqlSchema implements SqlSchema {
  public const TABLE_NAME = "product";

  public const COLUMN_ID = SampleSqlSchema::DEFAULT_COLUMN_ID;
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
    throw new MethodNotImplementedException();
  }
}
