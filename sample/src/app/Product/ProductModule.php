<?php

namespace Sample\Product;

use Harmony\Core\Module\Config\ModuleInterface;
use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Router\RouterConfiguratorInterface;
use Sample\Product\Command\TestCommand;
use Symfony\Component\Console\Command\Command;

class ProductModule implements ModuleInterface {
  public function getRouterConfig(): RouterConfiguratorInterface {
    return new ProductRoutes();
  }

  /** @return class-string<Command>[] */
  public function getCommands(): array {
    return [TestCommand::class];
  }

  public function getResolver(): ?ResolverInterface {
    return new ProductResolver();
  }
}
