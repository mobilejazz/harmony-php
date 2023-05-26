<?php

namespace Harmony\Core\Module\Symfony;

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

abstract class Route {
  public const GET = "GET";
  public const POST = "POST";
  public const PUT = "PUT";
  public const DELETE = "DELETE";

  protected RoutingConfigurator $routes;

  public function __construct(RoutingConfigurator $routes) {
    $this->routes = $routes;
  }

  abstract public function register(): void;
}
