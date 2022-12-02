<?php

namespace App\Tests\unit\Product\Domain\Interactor;

use Harmony\Core\Helper\Random;
use Harmony\Core\Repository\Error\DataNotFoundException;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use PHPUnit\Framework\TestCase;
use Sample\Product\Domain\Model\Product;
use Sample\Product\ProductProvider;

abstract class ProductInteractorsTest extends TestCase {
  abstract protected function getProvider(): ProductProvider;

  public function testCreateProductInteractor(): void {
    $productProvider = $this->getProvider();
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($productProvider, $product);

    $this->assertEquals($product, $productSaved);
  }

  public function testGetProductInteractor(): void {
    $productProvider = $this->getProvider();
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($productProvider, $product);

    $queryGet = new KeyQuery((string) $productSaved->id);
    $productGot = $productProvider->provideGetInteractor()($queryGet);

    $this->assertEquals($product, $productGot);
  }

  public function testUpdateProductInteractor(): void {
    $productProvider = $this->getProvider();
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($productProvider, $product);

    $productWithChange = new Product(
      id: $productSaved->id,
      name: Random::generateAlphaNumeric(),
      description: Random::generateAlphaNumeric(),
      price: $productSaved->price,
    );

    $productUpdated = $this->putProduct($productProvider, $productWithChange);

    $this->assertEquals($productWithChange, $productUpdated);

    $queryGet = new KeyQuery((string) $productSaved->id);
    $productGot = $productProvider->provideGetInteractor()($queryGet);

    $this->assertEquals($productWithChange, $productGot);
  }

  public function testCreateAllProductsInteractor(): void {
    $productProvider = $this->getProvider();
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($productProvider, $products);

    $this->assertEquals($products, $productsSaved);
  }

  public function testGetAllProductsInteractor(): void {
    $productProvider = $this->getProvider();
    $products = $this->getListOfProducts();
    $this->putProducts($productProvider, $products);

    $getQuery = new AllQuery();
    $allProductsGot = $productProvider->provideGetAllInteractor()($getQuery);

    $this->assertEquals($products, $allProductsGot);
  }

  public function testUpdateAllProductsInteractor(): void {
    $productProvider = $this->getProvider();
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($productProvider, $products);

    $productsWithChanges = [];

    foreach ($productsSaved as $productSaved) {
      $productsWithChanges[] = new Product(
        id: $productSaved->id,
        name: Random::generateAlphaNumeric(),
        description: Random::generateAlphaNumeric(),
        price: $productSaved->price,
      );
    }

    $productsUpdated = $this->putProducts(
      $productProvider,
      $productsWithChanges,
    );
    $this->assertEquals($productsWithChanges, $productsUpdated);

    $getQuery = new AllQuery();
    $allProductsGot = $productProvider->provideGetAllInteractor()($getQuery);

    $this->assertEquals($productsWithChanges, $allProductsGot);
  }

  public function testDeleteProductInteractor(): void {
    $productProvider = $this->getProvider();
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($productProvider, $product);

    $queryDelete = new KeyQuery((string) $productSaved->id);
    $productProvider->provideDeleteInteractor()($queryDelete);

    $queryGet = new KeyQuery((string) $productSaved->id);

    $this->expectException(DataNotFoundException::class);
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
