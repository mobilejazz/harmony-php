<?php

namespace Harmony\Core\Module\Config;

use Harmony\Core\Module\Router\RoutesInterface;
use Symfony\Component\Console\Command\Command;

interface ProviderInterface {
  public function getRoutes(): ?RoutesInterface;

  /** @return class-string<Command>[] */
  public function getCommands(): array;

  public function getResolver(): ?ResolverInterface;
}
