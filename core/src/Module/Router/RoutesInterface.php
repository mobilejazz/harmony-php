<?php

namespace Harmony\Core\Module\Router;

interface RoutesInterface {
  /**
   * @return Route[]
   */
  public function getRoutes(): array;
}
