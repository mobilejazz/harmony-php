<?php

namespace Sample\Product\Data\Sql\Mapper;

use Carbon\CarbonImmutable;
use Harmony\Core\Repository\Mapper\Mapper;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Sql\ProductSqlData;

/**
 * @implements Mapper<ProductSqlData, ProductEntity>
 */
class ProductSqlDataToEntityMapper implements Mapper {
  /**
   * @param ProductSqlData $from
   */
  public function map(mixed $from): ProductEntity {
    $entity = new ProductEntity(
      $from->id,
      $from->name,
      $from->description,
      $from->price,
      new CarbonImmutable($from->created_at),
    );

    return $entity;
  }
}
