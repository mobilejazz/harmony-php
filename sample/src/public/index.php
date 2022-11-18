<?php

use Sample\Application\ProductIndexAction;
use Sample\Product\ProductProvider;

require_once __DIR__ . "/../vendor/autoload.php";

$productProvider = new ProductProvider();
$controllerAction = new ProductIndexAction(
  $productProvider->provideGetInteractor(),
  $productProvider->provideGetAllInteractor(),
  $productProvider->providePutInteractor(),
  $productProvider->providePutAllInteractor(),
  $productProvider->provideDeleteInteractor(),
);

echo $controllerAction();
