<?php

namespace Harmony\Core\Module\DI;

use DI\ContainerBuilder;

interface ResolverInterface {
  public function register(ContainerBuilder $containerBuilder): void;
}
