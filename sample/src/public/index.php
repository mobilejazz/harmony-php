<?php

use Sample\Application\ProductIndexAction;
use Sample\Product\ProductModule;

require_once __DIR__ . "/../vendor/autoload.php";

$productProvider = new ProductModule();
$controllerAction = new ProductIndexAction(
  $productProvider->getGetInteractor(),
  $productProvider->getGetAllInteractor(),
  $productProvider->getPutInteractor(),
  $productProvider->getPutAllInteractor(),
  $productProvider->getDeleteInteractor(),
);

echo $controllerAction();
