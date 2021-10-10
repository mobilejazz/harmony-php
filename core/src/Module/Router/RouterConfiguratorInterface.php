<?php

namespace Harmony\Core\Module\Router;

use Symfony\Component\Routing\RouteCollection;

interface RouterConfiguratorInterface {
  public function __invoke(RouteCollection $router): void;
}
