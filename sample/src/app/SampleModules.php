<?php

namespace Sample;

use Harmony\Core\Module\Config\ModulesToLoadInterface;
use Sample\Product\ProductModule;

class SampleModules implements ModulesToLoadInterface {
  public function getModules(): array {
    return [ProductModule::class];
  }
}
