<?php

namespace Harmony\Core\Module\Config;

use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Router\RouterConfiguratorInterface;
use Harmony\Core\Module\Symfony\Console\HarmonyCommand;

interface ProviderInterface {
  public function getRouterConfig(): ?RouterConfiguratorInterface;

  /** @return class-string<HarmonyCommand>[] */
  public function getCommands(): array;

  public function getResolver(): ?ResolverInterface;
}
