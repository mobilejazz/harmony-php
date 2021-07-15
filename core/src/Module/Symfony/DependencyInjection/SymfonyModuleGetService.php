<?php

namespace Harmony\Core\Module\Symfony\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator;

// @phpstan-ignore-next-line
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

trait SymfonyModuleGetService {
  /**
   * @psalm-suppress UndefinedFunction
   */
  protected function getService(string $serviceName): ReferenceConfigurator {
    return service($serviceName);
  }
}
