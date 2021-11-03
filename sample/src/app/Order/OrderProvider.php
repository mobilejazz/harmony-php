<?php

namespace Sample\Order;

use Harmony\Core\Module\Config\ProviderInterface;

class OrderProvider implements ProviderInterface {
  /**
   * @inheritDoc
   */
  public function getRoutes(): array {
    return [];
  }

  /**
   * @inheritDoc
   */
  public function getCommands(): array {
    return [];
  }

  /**
   * @inheritDoc
   */
  public function getResolverDefinitions(): array {
    return [];
  }
}
