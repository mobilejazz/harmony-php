<?php

namespace Harmony\Core\Module\Routing;

interface RoutesInterface {
  /**
   * @return Route[]
   */
  public function getRoutes(): array;
}
