<?php

namespace Sample\Product\Data\Mapper;

use Carbon\CarbonImmutable;
use Harmony\Core\Data\Mapper\Mapper;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Domain\Model\Product;

/**
 * @template-implements Mapper<Product, ProductEntity>
 */
class ProductToProductEntityMapper implements Mapper {
  /**
   * @param Product $from
   */
  public function map($from): ProductEntity {
    $entity = new ProductEntity(
      $from->id,
      $from->name,
      $from->description,
      $from->price,
      new CarbonImmutable(),
    );

    return $entity;
  }
}
