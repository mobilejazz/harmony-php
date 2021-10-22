<?php

namespace Sample\Order;

use Harmony\Core\Module\Config\ProviderInterface;
use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Router\RouterConfiguratorInterface;

class OrderProvider implements ProviderInterface {
  public function getRouterConfig(): ?RouterConfiguratorInterface {
    return null;
  }

  public function getCommands(): array {
    return [];
  }

  public function getResolver(): ?ResolverInterface {
    return null;
  }
}
