<?php

namespace Sample\User;

use Harmony\Core\Module\Router\Route;
use Harmony\Core\Module\Router\RoutesInterface;
use Sample\User\Api\UserAction;

class UserRoutes implements RoutesInterface {
  public function getRoutes(): array {
    return [new Route("user_index", "/user", UserAction::class)];
  }
}
