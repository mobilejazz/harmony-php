<?php

namespace App\Tests\Sample\Product\Domain;

use Harmony\Core\Repository\Error\DataNotFoundException;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\KeyQuery;
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

  function testPutProductInteractor() {
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($product);

    $this->assertEquals($productSaved->getName(), $product->getName());
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

  function putProduct(Product $product): Product {
    $query = new KeyQuery((string) $product->getId());

    return $this->productProvider->getPutInteractor()($product, $query);
  }

  function putProducts(array $products): array {
    $query = new AllQuery();

    return $this->productProvider->getPutAllInteractor()($products, $query);
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

    $this->productProvider->getGetInteractor()(
      $queryGet,
    );

    $this->assertEquals($productSaved->getName(), $product->getName());
  }

  function testPutAllProductsInteractor() {
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($products);

    $this->assertEquals($products, $productsSaved);
  }

  #[Pure]
  function getListOfProducts(): array {
    return [$this->getProductOne(), $this->getProductTwo()];
  }

  #[Pure]
  function getProductTwo(): Product {
    return new Product(2, "XBox X", "VideoGames Console from Microsoft", 450.5);
  }

  function putProducts(array $products): array {
    $query = new AllQuery();

    return $this->productProvider->getPutAllInteractor()($query, new DefaultOperation(), $products);
  }

  function testGetAllProductsInteractor() {
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($products);

    $getQuery = new AllQuery();
    $allProducts = $this->productProvider->getGetAllInteractor()(
      $getQuery,
    );

    $this->assertEquals($productsSaved, $allProducts);
  }

  function testDeleteProductInteractor() {
    $this->expectException(DataNotFoundException::class);

    $product = $this->getProductOne();
    $productSaved = $this->putProduct($product);

    $queryDelete = new KeyQuery((string) $productSaved->getId());
    $this->productProvider->getDeleteInteractor()(
      $queryDelete,
    );

    $queryGet = new KeyQuery((string) $productSaved->getId());
    $this->productProvider->getGetInteractor()(
      $queryGet,
    );
  }
}
