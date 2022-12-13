<?php

use Harmony\Core\Repository\DataSource\InMemoryDataSource;
use Sample\Application\ProductIndexAction;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\ProductProvider;

require_once __DIR__ . "/../vendor/autoload.php";

$productProvider = new ProductProvider(
  new InMemoryDataSource(ProductEntity::class),
);
$controllerAction = new ProductIndexAction(
  $productProvider->provideGetInteractor(),
  $productProvider->provideGetAllInteractor(),
  $productProvider->providePutInteractor(),
  $productProvider->providePutAllInteractor(),
  $productProvider->provideDeleteInteractor(),
);

echo $controllerAction();
