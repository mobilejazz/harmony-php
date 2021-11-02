<?php

namespace Sample\Product;

use Harmony\Core\Module\Router\Route;
use Harmony\Core\Module\Router\RoutesInterface;
use Sample\Product\Controller\ProductAction;

class ProductRoutes implements RoutesInterface {
  /**
   * @return Route[]
   */
  public function getRoutes(): array {
    return [new Route("product_index", "/", ProductAction::class)];
  }
}
