<?php

use Sample\controllers\ProductController;
use Sample\product\ProductProvider;

require_once __DIR__ . '/../vendor/autoload.php';

$productProvider = new ProductProvider();
$controller = new ProductController(
    $productProvider->registerGetInteractor(),
    $productProvider->registerGetAllInteractor(),
    $productProvider->registerPutInteractor(),
    $productProvider->registerPutAllInteractor(),
    $productProvider->registerDeleteInteractor()
);

echo $controller->actionIndex();
