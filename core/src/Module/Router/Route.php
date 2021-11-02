<?php

namespace Harmony\Core\Module\Router;

/**
 * @psalm-immutable
 */
class Route {
  public function __construct(
    public string $name,
    public string $uri,
    public string $controllerAction,
  ) {
  }
}
