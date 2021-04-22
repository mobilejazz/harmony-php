<?php

namespace App\Tests\Sample\Product\Domain;

use harmony\core\repository\operation\DefaultOperation;
use harmony\core\repository\query\AllQuery;
use harmony\core\repository\query\KeyQuery;
use JetBrains\PhpStorm\Pure;
use PHPUnit\Framework\TestCase;
use Sample\product\domain\model\Product;
use Sample\product\ProductProvider;

class ProductInteractorsTest extends TestCase {
  /**
   * @var ProductProvider
   */
  private ProductProvider $productProvider;

  function setUp(): void {
    $this->productProvider = new ProductProvider();
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

    return $this->productProvider
      ->getPutInteractor()
      ->execute($query, new DefaultOperation(), $product);
  }

  function putProducts(array $products): array {
    $query = new AllQuery();

    return $this->productProvider
      ->getPutAllInteractor()
      ->execute($query, new DefaultOperation(), $products);
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

    $productGetted = $this->productProvider
      ->getGetInteractor()
      ->execute($queryGet, new DefaultOperation());

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
    $productsGetted = $this->productProvider
      ->getGetAllInteractor()
      ->execute($getQuery, new DefaultOperation());

    $this->assertEquals($productsSaved, $productsGetted);
  }

  function testDeleteProductInteractor() {
    $this->expectException(
      \harmony\core\repository\error\DataNotFoundException::class,
    );

    $product = $this->getProductOne();
    $productSaved = $this->putProduct($product);

    $queryDelete = new KeyQuery((string) $productSaved->getId());
    $this->productProvider
      ->getDeleteInteractor()
      ->execute($queryDelete, new DefaultOperation());

    $queryGet = new KeyQuery((string) $productSaved->getId());
    $this->productProvider
      ->getGetInteractor()
      ->execute($queryGet, new DefaultOperation());
  }
}
