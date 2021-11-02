<?php

namespace Sample\User;

use Harmony\Core\Module\Config\ProviderInterface;
use Harmony\Core\Module\Config\ResolverInterface;
use Harmony\Core\Module\Router\RoutesInterface;

class UserProvider implements ProviderInterface {
  public function getRoutes(): ?RoutesInterface {
    return new UserRoutes();
  }

  public function getCommands(): array {
    return [];
  }

  public function getResolver(): ?ResolverInterface {
    return new UserResolver();
  }
}
