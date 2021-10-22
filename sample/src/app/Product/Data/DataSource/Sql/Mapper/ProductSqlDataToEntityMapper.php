<?php

namespace Sample\Product\Data\DataSource\Sql\Mapper;

use Carbon\Carbon;
use Harmony\Core\Data\Mapper\Mapper;
use Sample\Product\Data\DataSource\Sql\ProductSqlSchema;
use Sample\Product\Data\Entity\ProductEntity;

class ProductSqlDataToEntityMapper implements Mapper {
  public function map(mixed $from): ProductEntity {
    return new ProductEntity(
      id: $from->{ProductSqlSchema::COLUMN_ID},
      name: $from->{ProductSqlSchema::COLUMN_NAME},
      description: $from->{ProductSqlSchema::COLUMN_DESCRIPTION},
      price: $from->{ProductSqlSchema::COLUMN_PRICE},
      created_at: new Carbon($from->{ProductSqlSchema::COLUMN_CREATED_AT}),
    );
  }
}
