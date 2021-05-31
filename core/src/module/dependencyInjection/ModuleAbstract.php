<?php

namespace harmony\core\module\dependencyInjection;

use Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

/**
 * @psalm-suppress UndefinedFunction
 */
abstract class ModuleAbstract {
  protected function getService(string $serviceName): ReferenceConfigurator {
    return service($serviceName);
  }
}
