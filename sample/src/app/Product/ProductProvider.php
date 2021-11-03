<?php

namespace Sample\Product;

use Harmony\Core\Module\Config\ProviderInterface;
use Sample\Product\Command\TestCommand;

class ProductProvider implements ProviderInterface {
  /**
   * @inheritDoc
   */
  public function getRoutes(): array {
    return (new ProductRoutes())();
  }

  /**
   * @inheritDoc
   */
  public function getCommands(): array {
    return [TestCommand::class];
  }

  /**
   * @inheritDoc
   */
  public function getResolverDefinitions(): array {
    return (new ProductResolver())();
  }
}
