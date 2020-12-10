<?php

use Sample\controllers\ProductController;
use Sample\product\ProductProvider;

require_once __DIR__ . '/../vendor/autoload.php';

$productProvider = new ProductProvider();
$controller = new ProductController(
    $productProvider->getGetInteractor(),
    $productProvider->getGetAllInteractor(),
    $productProvider->getPutInteractor(),
    $productProvider->getPutAllInteractor(),
    $productProvider->getDeleteInteractor(),
);

echo $controller->actionIndex();
