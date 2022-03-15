<?php

namespace Harmony\Core\Module\Symfony;

use Harmony\Core\Module\Symfony\DependencyInjection\SymfonyModule;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

abstract class BaseKernel extends Kernel {
  use MicroKernelTrait;

  abstract protected function getModules(): array;

  abstract protected function getRouters(): array;

  abstract protected function getRootFolder(): string;

  protected function configureContainer(
    ContainerConfigurator $container
  ): void {
    $this->configureContainerBase($container);

    $registerModules = $this->getModules();

    /** @var SymfonyModule $moduleProvider */
    foreach ($registerModules as $moduleProvider) {
      $module = new $moduleProvider();
      $module->register($container->services());
      unset($module);
    }
  }

  protected function configureRoutes(RoutingConfigurator $routes): void {
    $this->configureRoutesBase($routes);

    $registerRoutes = $this->getRouters();

    foreach ($registerRoutes as $classWithRoutes) {
      /** @var Route $route */
      $route = new $classWithRoutes($routes);
      $route->register();

      unset($route);
    }
  }

  protected function configureContainerBase(
    ContainerConfigurator $container
  ): void {
    $rootFolder = $this->getRootFolder();

    $container->import("../config/{packages}/*.yaml");
    $container->import(
      "../config/{packages}/" . $this->environment . "/*.yaml",
    );

    if (is_file($rootFolder . "/config/services.yaml")) {
      $container->import("../config/services.yaml");
      $container->import(
        "../config/{services}_" . $this->environment . ".yaml",
      );
    } elseif (is_file($path = $rootFolder . "/config/services.php")) {
      require $path($container->withPath($path), $this);
    }
  }

  protected function configureRoutesBase(RoutingConfigurator $routes): void {
    $rootFolder = $this->getRootFolder();

    $routes->import("../config/{routes}/" . $this->environment . "/*.yaml");
    $routes->import("../config/{routes}/*.yaml");

    if (is_file($rootFolder . "/config/routes.yaml")) {
      $routes->import("../config/routes.yaml");
    } elseif (is_file($path = $rootFolder . "/config/routes.php")) {
      require $path($routes->withPath($path), $this);
    }
  }
}
