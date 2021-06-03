<?php

namespace Sample\Product\Data\Mapper;

use harmony\core\Repository\Mapper\GenericMapper;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Domain\Model\Product;

/**
 * @extends GenericMapper<ProductEntity, Product>
 */
class ProductEntityToProductMapper extends GenericMapper {
  public function __construct() {
    parent::__construct(ProductEntity::class, Product::class);
  }

  /**
   * @param ProductEntity $from
   *
   * @return Product
   */
  protected function overrideMap($from): Product {
    $model = new Product(
      $from->getId(),
      $from->getName(),
      $from->getDescription(),
      $from->getPrice(),
    );

    return $model;
  }
}
