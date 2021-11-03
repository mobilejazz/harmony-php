<?php

namespace Harmony\Core\Module\Config;

use Harmony\Core\Module\Router\Route;
use Symfony\Component\Console\Command\Command;

interface ProviderInterface {
  /**
   * @return Route[]
   */
  public function getRoutes(): array;

  /**
   * @return class-string<Command>[]
   */
  public function getCommands(): array;

  /**
   * @return array<string, callable>
   */
  public function getResolverDefinitions(): array;
}
