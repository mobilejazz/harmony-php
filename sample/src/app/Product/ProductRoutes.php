<?php

namespace Sample\Product;

use Harmony\Core\Module\Router\RouterConfiguratorInterface;
use Sample\Product\Controller\ProductAction;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class ProductRoutes implements RouterConfiguratorInterface {
  public function __invoke(RouteCollection $router): void {
    $route = new Route("/", [
      "_controller" => ProductAction::class,
    ]);
    $router->add("product_index", $route);
  }
}
