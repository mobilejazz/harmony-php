<?php

namespace Harmony\Core\Module\Config;

use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Router\RouterConfiguratorInterface;
use Symfony\Component\Console\Command\Command;

interface ModuleInterface {
  public function getRouterConfig(): ?RouterConfiguratorInterface;

  /** @return class-string<Command>[] */
  public function getCommands(): array;

  public function getResolver(): ?ResolverInterface;
}
