<?php

namespace Sample\Product;

use Harmony\Core\Module\Config\ModuleInterface;
use Harmony\Core\Module\Console\ControllerCommandInterface;
use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Router\RouterConfiguratorInterface;
use Sample\Product\Command\TestCommand;

class ProductModule implements ModuleInterface {
  public function getRouterConfig(): RouterConfiguratorInterface {
    return new ProductRoutes();
  }

  /** @return string-class<ControllerCommandInterface>[] */
  public function getCommands(): array {
    return [TestCommand::class];
  }

  public function getResolver(): ?ResolverInterface {
    return new ProductResolver();
  }
}
