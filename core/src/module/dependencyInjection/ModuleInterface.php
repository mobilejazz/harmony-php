<?php

namespace harmony\core\module\dependencyInjection;

use Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator;

interface ModuleInterface {
  public function register(ServicesConfigurator $container): void;
}
