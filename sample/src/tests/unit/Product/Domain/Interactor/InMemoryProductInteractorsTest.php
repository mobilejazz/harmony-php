<?php

namespace App\Tests\unit\Product\Domain\Interactor;

use Harmony\Core\Repository\DataSource\InMemoryDataSource;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\ProductProvider;

/**
 * @see InMemoryDataSource
 */
class InMemoryProductInteractorsTest extends ProductInteractorsTest {
  protected function getProvider(): ProductProvider {
    return new ProductProvider(new InMemoryDataSource(ProductEntity::class));
  }
}
