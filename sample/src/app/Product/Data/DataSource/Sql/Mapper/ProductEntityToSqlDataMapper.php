<?php

namespace Sample\Product\Data\DataSource\Sql\Mapper;

use Harmony\Core\Data\Mapper\Mapper;
use Sample\Product\Data\DataSource\Sql\ProductSqlSchema;
use Sample\Product\Data\Entity\ProductEntity;
use stdClass;

class ProductEntityToSqlDataMapper implements Mapper {
  /**
   * @param ProductEntity $from
   *
   * @return stdClass
   */
  public function map(mixed $from): stdClass {
    $to = new stdClass();
    $to->{ProductSqlSchema::COLUMN_ID} = $from->id;
    $to->{ProductSqlSchema::COLUMN_NAME} = $from->name;
    $to->{ProductSqlSchema::COLUMN_DESCRIPTION} = $from->description;
    $to->{ProductSqlSchema::COLUMN_PRICE} = $from->price;
    $to->{ProductSqlSchema::COLUMN_CREATED_AT} = $from->created_at;

    return $to;
  }
}
