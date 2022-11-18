<?php

namespace App\Tests\unit\Product\Domain\Interactor;

use Sample\Product\ProductProvider;

class InMemoryProductInteractorsTest extends ProductInteractors {
  protected function getProvider(): ProductProvider {
    return new ProductProvider();
  }
}
