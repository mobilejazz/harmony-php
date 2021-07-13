<?php

namespace Sample\Product\Data\Mapper;

use Harmony\Core\Repository\Mapper\Mapper;
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
      $from->getId(),
      $from->getName(),
      $from->getDescription(),
      $from->getPrice(),
    );

    return $model;
  }
}
