<?php

namespace Harmony\Core\Module\Kernel;

use DI\Container;
use DI\ContainerBuilder;
use Harmony\Core\Module\Config\Env\DotEnvPathsContainerInterface;
use Harmony\Core\Module\Config\ModuleInterface;
use Harmony\Core\Module\Config\ModulesToLoadInterface;
use Harmony\Core\Module\Router\RouterConfiguratorInterface;
use Harmony\Core\Module\Symfony\Console\HarmonyCommand;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Kernel {
  /** @var ModuleInterface[] */
  protected array $modules = [];
  /** @var class-string<HarmonyCommand>[] */
  protected array $moduleCommands = [];
  /** @var RouterConfiguratorInterface[] */
  protected array $moduleRoutes = [];

  protected Container $diContainer;
  protected RequestContext $context;
  protected RouteCollection $routes;
  protected UrlGenerator $urlGenerator;

  public function __construct(
    protected ?DotEnvPathsContainerInterface $dotEnvs = null,
    protected ?ModulesToLoadInterface $modulesToLoad = null,
  ) {
    $this->loadEnv();
    $this->loadModules();
    $this->loadDI();
    $this->loadCommands();
    $this->loadRoutes();
    $this->loadRouting();
  }

  protected function loadEnv(): void {
    if ($this->dotEnvs === null) {
      return;
    }

    $dotenv = new Dotenv();
    $dotEnvPaths = $this->dotEnvs->getEnvPaths();

    foreach ($dotEnvPaths as $path) {
      $dotenv->load($path->value);

      unset($path);
    }
  }

  protected function loadModules(): void {
    if ($this->modulesToLoad === null) {
      return;
    }

    foreach ($this->modulesToLoad->getModules() as $module) {
      $this->modules[] = new $module();

      unset($module);
    }
  }

  protected function loadDI(): void {
    $diBuilder = new ContainerBuilder();

    foreach ($this->modules as $module) {
      $resolver = $module->getResolver();
      $resolver?->register($diBuilder);

      unset($resolver);
    }

    $this->diContainer = $diBuilder->build();
  }

  protected function loadCommands(): void {
    foreach ($this->modules as $module) {
      $commands = $module->getCommands();
      $this->moduleCommands += $commands;

      unset($commands);
    }
  }

  protected function loadRoutes(): void {
    foreach ($this->modules as $module) {
      $moduleRoutes = $module->getRouterConfig();

      if ($moduleRoutes !== null) {
        $this->moduleRoutes[] = $moduleRoutes;
      }

      unset($moduleRoutes);
    }
  }

  protected function loadRouting(): void {
    $this->routes = new RouteCollection();

    foreach ($this->moduleRoutes as $moduleRouter) {
      $moduleRouter($this->routes);
    }

    $this->context = new RequestContext();

    $this->urlGenerator = new UrlGenerator($this->routes, $this->context);
  }
}
