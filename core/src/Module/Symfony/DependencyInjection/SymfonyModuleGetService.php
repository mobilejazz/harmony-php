<?php

namespace Harmony\Core\Module\Symfony\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

trait SymfonyModuleGetService {
  protected function getService(string $serviceName): ReferenceConfigurator {
    return service($serviceName);
  }
}
