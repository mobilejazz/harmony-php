<?php

namespace harmony\core\Module\Symfony\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator;

interface SymfonyModule {
  public function register(ServicesConfigurator $container): void;
}
