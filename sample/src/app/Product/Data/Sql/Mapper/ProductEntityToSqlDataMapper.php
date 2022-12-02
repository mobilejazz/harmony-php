<?php

namespace Sample\Product\Data\Sql\Mapper;

use Harmony\Core\Repository\Mapper\Mapper;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Sql\ProductSqlData;

/**
 * @implements Mapper<ProductEntity, ProductSqlData>
 */
class ProductEntityToSqlDataMapper implements Mapper {
  /**
   * @param ProductEntity $from
   */
  public function map(mixed $from): ProductSqlData {
    $data = new ProductSqlData(
      $from->id,
      $from->name,
      $from->description,
      $from->price,
      $from->createdAt?->toDateTimeString(),
    );

    return $data;
  }
}
