<?php

namespace Harmony\Core\Module\Config;

use Harmony\Core\Module\Console\ControllerCommandInterface;
use Harmony\Core\Module\Router\RouterConfiguratorInterface;

interface ModuleInterface {
  public function getRouterConfig(): RouterConfiguratorInterface;

  /** @return string-class<ControllerCommandInterface>[] */
  public function getCommands(): array;
}
