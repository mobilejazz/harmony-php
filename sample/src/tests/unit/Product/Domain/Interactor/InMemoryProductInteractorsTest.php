<?php

namespace App\Tests\unit\Product\Domain\Interactor;

use Harmony\Core\Module\Memory\DataSource\InMemoryDataSource;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\ProductProvider;

/**
 * @see InMemoryDataSource
 */
class InMemoryProductInteractorsTest extends ProductInteractorsTest {
  protected function getProvider(): ProductProvider {
    $dataSource = new InMemoryDataSource(ProductEntity::class);

    return new ProductProvider(
      dataSource: $dataSource,
      arrayDataSource: $dataSource,
    );
  }
}
