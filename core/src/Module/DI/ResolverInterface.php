<?php

namespace Harmony\Core\Module\DI;

use Symfony\Component\DependencyInjection\ContainerBuilder;

interface ResolverInterface {
  public function register(ContainerBuilder $containerBuilder): void;
}
