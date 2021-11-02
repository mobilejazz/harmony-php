<?php

namespace Sample\Order;

use Harmony\Core\Module\Config\ProviderInterface;
use Harmony\Core\Module\Config\ResolverInterface;
use Harmony\Core\Module\Router\RoutesInterface;

class OrderProvider implements ProviderInterface {
  public function getRoutes(): ?RoutesInterface {
    return null;
  }

  public function getCommands(): array {
    return [];
  }

  public function getResolver(): ?ResolverInterface {
    return null;
  }
}
