<?php

namespace Harmony\Core\Module\Kernel;

use Harmony\Core\Module\Config\Env\DotEnvPathsContainerInterface;
use Harmony\Core\Module\Config\ModuleInterface;
use Harmony\Core\Module\Config\ModulesToLoadInterface;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Kernel {
  /** @var ModuleInterface[] */
  protected array $modules;
  /** @var string[] */
  protected array $moduleCommands = [];
  /** @var string[] */
  protected array $moduleRoutes = [];

  protected Request $request;
  protected RequestContext $context;
  protected RouteCollection $routes;
  protected UrlGenerator $urlGenerator;

  public function __construct(
    protected ?DotEnvPathsContainerInterface $dotEnvs = null,
    protected ?ModulesToLoadInterface $modulesToLoad = null,
  ) {
  }

  public function bootstrap(?Request $request = null): void {
    if ($request !== null) {
      $this->request = $request;
    }

    $this->loadEnv();
    $this->loadModules();
    $this->loadCommands();
    $this->loadRoutes();
    $this->loadRouting();
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

  protected function loadCommands(): void {
    foreach ($this->modules as $module) {
      $commands = $module->getCommands();
      $this->moduleCommands = [...$this->moduleCommands, ...$commands];

      unset($commands);
    }
  }

  protected function loadRoutes(): void {
    foreach ($this->modules as $module) {
      $moduleRoutes = $module->getRouterConfig();
      $this->moduleRoutes[] = $moduleRoutes;

      unset($moduleRoutes);
    }
  }

  protected function loadRouting(): void {
    $this->routes = new RouteCollection();

    foreach ($this->moduleRoutes as $moduleRouter) {
      $moduleRouter($this->routes);
    }

    $this->context = new RequestContext();

    if (!empty($this->request)) {
      $this->context->fromRequest($this->request);
    }

    $this->urlGenerator = new UrlGenerator($this->routes, $this->context);
    // $url = $this->urlGenerator->generate("blog_show", [
    //   "slug" => "my-blog-post",
    // ]);
    // $url = '/blog/my-blog-post'
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
}
