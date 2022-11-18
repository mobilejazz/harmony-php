<?php

namespace App\Tests\unit\Product\Domain\Interactor;

use Sample\Product\ProductProvider;

class InMemoryProductInteractorsTestTest extends ProductInteractorsTest {
  protected function getProvider(): ProductProvider {
    return new ProductProvider();
  }
}
