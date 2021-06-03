<?php

namespace App\Tests\Sample\Product\Domain;

use harmony\core\Repository\Operation\DefaultOperation;
use harmony\core\Repository\Query\AllQuery;
use harmony\core\Repository\Query\KeyQuery;
use JetBrains\PhpStorm\Pure;
use PHPUnit\Framework\TestCase;
use Sample\Product\Domain\Model\Product;
use Sample\Product\ProductModule;

class ProductInteractorsTest extends TestCase {
  /**
   * @var ProductModule
   */
  private ProductModule $productProvider;

  function setUp(): void {
    $this->productProvider = new ProductModule();
  }

  #[Pure]
  function getProductOne(): Product {
    return new Product(
      1,
      "PlayStation 5",
      "VideoGames Console from Sony.",
      599.99,
    );
  }

  #[Pure]
  function getProductTwo(): Product {
    return new Product(2, "XBox X", "VideoGames Console from Microsoft", 450.5);
  }

  #[Pure]
  function getListOfProducts(): array {
    return [$this->getProductOne(), $this->getProductTwo()];
  }

  function putProduct(Product $product): Product {
    $query = new KeyQuery((string) $product->getId());

    return $this->productProvider->getPutInteractor()($query, new DefaultOperation(), $product);
  }

  function putProducts(array $products): array {
    $query = new AllQuery();

    return $this->productProvider->getPutAllInteractor()($query, new DefaultOperation(), $products);
  }

  function testPutProductInteractor() {
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($product);

    $this->assertEquals($productSaved->getName(), $product->getName());
  }

  function testGetProductInteractor() {
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($product);

    $queryGet = new KeyQuery((string) $productSaved->getId());

    $productGetted = $this->productProvider->getGetInteractor()(
      $queryGet,
      new DefaultOperation(),
    );

    $this->assertEquals($productSaved->getName(), $product->getName());
  }

  function testPutAllProductsInteractor() {
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($products);

    $this->assertEquals($products, $productsSaved);
  }

  function testGetAllProductsInteractor() {
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($products);

    $getQuery = new AllQuery();
    $productsGetted = $this->productProvider->getGetAllInteractor()(
      $getQuery,
      new DefaultOperation(),
    );

    $this->assertEquals($productsSaved, $productsGetted);
  }

  function testDeleteProductInteractor() {
    $this->expectException(
      \harmony\core\Repository\Error\DataNotFoundException::class,
    );

    $product = $this->getProductOne();
    $productSaved = $this->putProduct($product);

    $queryDelete = new KeyQuery((string) $productSaved->getId());
    $this->productProvider->getDeleteInteractor()(
      $queryDelete,
      new DefaultOperation(),
    );

    $queryGet = new KeyQuery((string) $productSaved->getId());
    $this->productProvider->getGetInteractor()(
      $queryGet,
      new DefaultOperation(),
    );
  }
}
