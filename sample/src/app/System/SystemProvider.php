<?php

namespace Sample\System;

use Harmony\Core\Module\Config\ProviderInterface;
use Harmony\Core\Module\Config\ResolverInterface;
use Harmony\Core\Module\Router\RoutesInterface;
use Symfony\Component\Console\Command\Command;

class SystemProvider implements ProviderInterface {
  public function getRoutes(): ?RoutesInterface {
    return null;
  }

  /** @return class-string<Command>[] */
  public function getCommands(): array {
    return [];
  }

  public function getResolver(): ?ResolverInterface {
    return new SystemResolver();
  }
}
