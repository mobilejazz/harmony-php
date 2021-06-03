<?php

namespace Sample\Product\Data\Mapper;

use Harmony\Core\Repository\Mapper\GenericMapper;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Domain\Model\Product;

/**
 * @extends GenericMapper<Product, ProductEntity>
 */
class ProductToProductEntityMapper extends GenericMapper {
  public function __construct() {
    parent::__construct(Product::class, ProductEntity::class);
  }

  /**
   * @param Product $from
   *
   * @return ProductEntity
   */
  protected function overrideMap($from): ProductEntity {
    $entity = new ProductEntity(
      $from->getId(),
      $from->getName(),
      $from->getDescription(),
      $from->getPrice(),
    );

    return $entity;
  }
}
