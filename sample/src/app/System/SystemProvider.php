<?php

namespace Sample\System;

use Harmony\Core\Module\Config\ProviderInterface;
use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Router\RouterConfiguratorInterface;
use Harmony\Core\Module\Symfony\Console\HarmonyCommand;

class SystemProvider implements ProviderInterface {
  public function getRouterConfig(): ?RouterConfiguratorInterface {
    return null;
  }

  /** @return class-string<HarmonyCommand>[] */
  public function getCommands(): array {
    return [];
  }

  public function getResolver(): ?ResolverInterface {
    return new SystemResolver();
  }
}
