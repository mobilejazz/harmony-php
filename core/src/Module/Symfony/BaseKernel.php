<?php

namespace Harmony\Core\Module\Symfony;

use Harmony\Core\Module\Api\Request\RequestDTOFactory;
use Harmony\Core\Module\Routing\RoutesInterface;
use Harmony\Core\Module\Symfony\DependencyInjection\SymfonyModule;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

abstract class BaseKernel extends Kernel {
  use MicroKernelTrait;

  /** @var \Harmony\Core\Module\Routing\Route[] */
  protected array $routes = [];

  abstract protected function getModules(): array;

  abstract protected function getRouters(): array;

  abstract protected function getRootFolder(): string;

  protected function getRoutersModule(): array {
    if (!empty($this->routes)) {
      return $this->routes;
    }

    $registerRoutes = $this->getRouters();

    foreach ($registerRoutes as $classWithRoutes) {
      /** @var RoutesInterface $routesContainer */
      $routesContainer = new $classWithRoutes();
      $routes = $routesContainer->getRoutes();
      array_push($this->routes, ...$routes);

      unset($routesContainer, $routes);
    }

    return $this->routes;
  }

  protected function configureContainer(
    ContainerConfigurator $container
  ): void {
    $this->configureSymfonyContainer($container);

    $registerModules = $this->getModules();

    /** @var SymfonyModule $moduleProvider */
    foreach ($registerModules as $moduleProvider) {
      $module = new $moduleProvider();
      $module->register($container->services());
      unset($module);
    }

    $this->registerControllerActions($container);
    $this->registerRequestDTOs($container);
  }

  protected function registerControllerActions(
    ContainerConfigurator $container
  ): void {
    foreach ($this->getRoutersModule() as $route) {
      $container
        ->services()
        ->set($route->controllerAction)
        ->autowire()
        ->tag("controller.service_arguments");

      unset($route);
    }
  }

  protected function registerRequestDTOs(
    ContainerConfigurator $container
  ): void {
    $container
      ->services()
      ->set(RequestDTOFactory::class)
      ->autowire();

    foreach ($this->getRoutersModule() as $route) {
      if (empty($route->requestDTO)) {
        continue;
      }

      $container
        ->services()
        ->set($route->requestDTO)
        ->factory(service(RequestDTOFactory::class))
        ->args([$route->requestDTO]);

      unset($route);
    }
  }

  protected function configureRoutes(RoutingConfigurator $routes): void {
    $this->configureSymfonyRoutes($routes);

    foreach ($this->getRoutersModule() as $route) {
      $routes
        ->add($route->name, $route->path)
        ->controller($route->controllerAction)
        ->methods($route->methods);

      unset($route);
    }
  }

  protected function configureSymfonyContainer(
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

  protected function configureSymfonyRoutes(RoutingConfigurator $routes): void {
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
