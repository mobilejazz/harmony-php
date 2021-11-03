<?php

namespace Harmony\Core\Module\Kernel;

use DI\Container;
use DI\ContainerBuilder;
use Exception;
use Harmony\Core\Module\Config\Env\DotEnvPathsContainerInterface;
use Harmony\Core\Module\Config\ModulesToLoadInterface;
use Harmony\Core\Module\Config\ProviderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Kernel {
  /** @var ProviderInterface[] */
  protected array $modules = [];

  protected Container $diContainer;

  /** @var class-string<Command>[] */
  protected array $commands = [];

  protected RouteCollection $routes;
  protected UrlGenerator $urlGenerator;

  protected RequestContext $context;

  public function __construct(
    protected ?DotEnvPathsContainerInterface $dotEnvs = null,
    protected ?ModulesToLoadInterface $modulesToLoad = null,
  ) {
    $this->loadEnv();
    $this->loadModules();
    $this->loadDI();
    $this->loadCommands();
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

    foreach ($this->modulesToLoad->getProviders() as $module) {
      $this->modules[] = new $module();

      unset($module);
    }
  }

  /**
   * @throws Exception
   */
  protected function loadDI(): void {
    $diBuilder = new ContainerBuilder();

    foreach ($this->modules as $module) {
      $definitions = $module->getResolverDefinitions();
      $diBuilder->addDefinitions($definitions);

      unset($definitions);
    }

    $this->diContainer = $diBuilder->build();
  }

  protected function loadCommands(): void {
    foreach ($this->modules as $module) {
      $commands = $module->getCommands();
      $this->commands += $commands;

      unset($commands);
    }
  }

  protected function loadRouting(): void {
    $this->routes = new RouteCollection();

    foreach ($this->modules as $module) {
      $routes = $module->getRoutes();

      foreach ($routes as $route) {
        $symfonyRoute = new Route($route->uri, [
          "_controller" => $route->controllerAction,
        ]);
        $this->routes->add($route->name, $symfonyRoute);
      }
    }

    $this->context = new RequestContext();
    $this->urlGenerator = new UrlGenerator($this->routes, $this->context);
  }
}
