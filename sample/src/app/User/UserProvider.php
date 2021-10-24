<?php

namespace Sample\User;

use Harmony\Core\Module\Config\ProviderInterface;
use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Router\RouterConfiguratorInterface;

class UserProvider implements ProviderInterface {
  public function getRouterConfig(): ?RouterConfiguratorInterface {
    return new UserRoutes();
  }

  public function getCommands(): array {
    return [];
  }

  public function getResolver(): ?ResolverInterface {
    return null;
  }
}
