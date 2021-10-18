<?php

namespace Sample\Product\Data\Mapper;

use Harmony\Core\Data\Mapper\Mapper;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Domain\Model\Product;

/**
 * @template-implements Mapper<ProductEntity, Product>
 */
class ProductEntityToProductMapper implements Mapper {
  /**
   * @param ProductEntity $from
   *
   * @return Product
   */
  public function map($from): Product {
    $model = new Product(
      $from->id,
      $from->name,
      $from->description,
      $from->price,
    );

    return $model;
  }
}
