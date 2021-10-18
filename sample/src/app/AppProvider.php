<?php

namespace Sample;

use Harmony\Core\Module\Config\ModulesToLoadInterface;
use Sample\Product\ProductProvider;

class AppProvider implements ModulesToLoadInterface {
  public function getProviders(): array {
    return [ProductProvider::class];
  }
}
