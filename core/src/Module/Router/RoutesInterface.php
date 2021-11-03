<?php

namespace Harmony\Core\Module\Router;

interface RoutesInterface {
  /**
   * @return Route[]
   */
  public function __invoke(): array;
}
