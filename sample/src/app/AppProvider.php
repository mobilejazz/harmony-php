<?php

namespace Sample;

use Harmony\Core\Module\Config\ModulesToLoadInterface;
use Sample\Product\ProductProvider;
use Sample\System\SystemProvider;
use Sample\User\UserProvider;

class AppProvider implements ModulesToLoadInterface {
  public function getProviders(): array {
    return [SystemProvider::class, UserProvider::class, ProductProvider::class];
  }
}
