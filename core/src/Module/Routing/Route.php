<?php

namespace Harmony\Core\Module\Routing;

class Route {
  public function __construct(
    public readonly string $name,
    public readonly string $path,
    public readonly string $controllerAction,
    public readonly ?string $requestDTO = null,
    /** @var string[] */
    public readonly array $methods = [Method::GET]
  ) {
  }
}
