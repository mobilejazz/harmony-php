<?php

namespace App\Tests\unit\Product\Domain\Interactor;

use Harmony\Core\Repository\Error\DataNotFoundException;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use PHPUnit\Framework\TestCase;
use Sample\Product\Domain\Model\Product;
use Sample\Product\ProductProvider;

abstract class ProductInteractors extends TestCase {
  abstract protected function getProvider(): ProductProvider;

  public function testPutProductInteractor(): void {
    $productProvider = $this->getProvider();
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($productProvider, $product);

    $this->assertEquals($productSaved->name, $product->name);
  }

  public function testGetProductInteractor(): void {
    $productProvider = $this->getProvider();
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($productProvider, $product);

    $queryGet = new KeyQuery((string) $productSaved->id);

    $productProvider->provideGetInteractor()($queryGet);

    $this->assertEquals($productSaved->name, $product->name);
  }

  public function testPutAllProductsInteractor(): void {
    $productProvider = $this->getProvider();
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($productProvider, $products);

    $this->assertEquals($products, $productsSaved);
  }

  public function testGetAllProductsInteractor(): void {
    $productProvider = $this->getProvider();
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($productProvider, $products);

    $getQuery = new AllQuery();
    $allProducts = $productProvider->provideGetAllInteractor()($getQuery);

    $this->assertEquals($productsSaved, $allProducts);
  }

  public function testDeleteProductInteractor(): void {
    $this->expectException(DataNotFoundException::class);

    $productProvider = $this->getProvider();
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($productProvider, $product);

    $queryDelete = new KeyQuery((string) $productSaved->id);
    $productProvider->provideDeleteInteractor()($queryDelete);

    $queryGet = new KeyQuery((string) $productSaved->id);
    $productProvider->provideGetInteractor()($queryGet);
  }

  public function getProductOne(): Product {
    return new Product(
      1,
      "PlayStation 5",
      "VideoGames Console from Sony.",
      599.99,
    );
  }

  public function getProductTwo(): Product {
    return new Product(2, "XBox X", "VideoGames Console from Microsoft", 450.5);
  }

  /**
   * @return Product[]
   */
  public function getListOfProducts(): array {
    return [$this->getProductOne(), $this->getProductTwo()];
  }

  public function putProduct(
    ProductProvider $productProvider,
    Product $product,
  ): Product {
    $query = new KeyQuery((string) $product->id);

    return $productProvider->providePutInteractor()($product, $query);
  }

  /**
   * @param Product[] $products
   *
   * @return Product[]
   */
  public function putProducts(
    ProductProvider $productProvider,
    array $products,
  ): array {
    $query = new AllQuery();

    return $productProvider->providePutAllInteractor()($products, $query);
  }
}
