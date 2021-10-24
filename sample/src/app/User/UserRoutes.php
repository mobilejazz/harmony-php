<?php

namespace Sample\User;

use Harmony\Core\Module\Router\RouterConfiguratorInterface;
use Sample\User\Api\UserAction;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class UserRoutes implements RouterConfiguratorInterface {
  public function __invoke(RouteCollection $router): void {
    $route = new Route("/user", [
      "_controller" => UserAction::class,
    ]);
    $router->add("user_index", $route);
  }
}
