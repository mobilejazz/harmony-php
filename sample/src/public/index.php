<?php

use Sample\Controller\ProductController;
use Sample\Product\ProductModule;

require_once __DIR__ . "/../vendor/autoload.php";

$productProvider = new ProductModule();
$controller = new ProductController(
  $productProvider->getGetInteractor(),
  $productProvider->getGetAllInteractor(),
  $productProvider->getPutInteractor(),
  $productProvider->getPutAllInteractor(),
  $productProvider->getDeleteInteractor(),
);

echo $controller->actionIndex();
