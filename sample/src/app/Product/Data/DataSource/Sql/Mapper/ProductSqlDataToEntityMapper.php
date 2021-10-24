<?php

namespace Sample\Product\Data\DataSource\Sql\Mapper;

use Carbon\Carbon;
use Harmony\Core\Data\Mapper\Mapper;
use Sample\Product\Data\DataSource\Sql\ProductSqlSchema;
use Sample\Product\Data\Entity\ProductEntity;

class ProductSqlDataToEntityMapper implements Mapper {
  public function map(mixed $from): ProductEntity {
    return new ProductEntity(
      $from->{ProductSqlSchema::COLUMN_ID},
      $from->{ProductSqlSchema::COLUMN_NAME},
      $from->{ProductSqlSchema::COLUMN_DESCRIPTION},
      $from->{ProductSqlSchema::COLUMN_PRICE},
      new Carbon($from->{ProductSqlSchema::COLUMN_CREATED_AT}),
    );
  }
}
