<?php

namespace Sample\Product;

use Harmony\Core\Module\Config\ProviderInterface;
use Harmony\Core\Module\Config\ResolverInterface;
use Harmony\Core\Module\Router\RoutesInterface;
use Sample\Product\Command\TestCommand;
use Symfony\Component\Console\Command\Command;

class ProductProvider implements ProviderInterface {
  public function getRoutes(): ?RoutesInterface {
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
