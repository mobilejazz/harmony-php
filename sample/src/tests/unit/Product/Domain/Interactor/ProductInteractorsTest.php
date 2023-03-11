<?php

namespace App\Tests\unit\Product\Domain\Interactor;

use Harmony\Core\Data\Error\DataNotFoundException;
use Harmony\Core\Data\Query\AllQuery;
use Harmony\Core\Data\Query\IdQuery;
use Harmony\Core\Helper\Random;
use PHPUnit\Framework\TestCase;
use Sample\Product\Domain\Model\Product;
use Sample\Product\ProductProvider;

abstract class ProductInteractorsTest extends TestCase {
  abstract protected function getProvider(): ProductProvider;

  public function testCreateProductInteractor(): void {
    [
      $productProvider,
      $product,
      $createdProduct,
    ] = $this->createAndGetProduct();

    $this->assertEquals($product, $createdProduct);
  }

  public function testGetProductInteractor(): void {
    [
      $productProvider,
      $product,
      $createdProduct,
    ] = $this->createAndGetProduct();

    $getQuery = new IdQuery((string) $createdProduct->id);
    $resultingProduct = $productProvider->provideGetInteractor()($getQuery);

    $this->assertEquals($product, $resultingProduct);
  }

  public function testUpdateProductInteractor(): void {
    [
      $productProvider,
      $product,
      $createdProduct,
    ] = $this->createAndGetProduct();

    $editedProduct = new Product(
      id: $createdProduct->id,
      name: Random::generateAlphaNumeric(),
      description: Random::generateAlphaNumeric(),
      price: $createdProduct->price,
    );

    $updatedProduct = $this->putProduct($productProvider, $editedProduct);

    $this->assertEquals($editedProduct, $updatedProduct);

    $getQuery = new IdQuery((string) $createdProduct->id);
    $resultingProduct = $productProvider->provideGetInteractor()($getQuery);

    $this->assertEquals($editedProduct, $resultingProduct);
  }

  public function testCreateAllProductsInteractor(): void {
    [
      $productProvider,
      $products,
      $createdProducts,
    ] = $this->createAndGetProducts();

    $this->assertEquals($products, $createdProducts);
  }

  public function testGetAllProductsInteractor(): void {
    [
      $productProvider,
      $products,
      $createdProducts,
    ] = $this->createAndGetProducts();

    $getQuery = new AllQuery();
    $resultingProducts = $productProvider->provideGetAllInteractor()($getQuery);

    $this->assertEquals($products, $resultingProducts);
  }

  public function testUpdateAllProductsInteractor(): void {
    [
      $productProvider,
      $products,
      $createdProducts,
    ] = $this->createAndGetProducts();

    $editedProducts = [];

    foreach ($createdProducts as $createdProduct) {
      $editedProducts[] = new Product(
        id: $createdProduct->id,
        name: Random::generateAlphaNumeric(),
        description: Random::generateAlphaNumeric(),
        price: $createdProduct->price,
      );
    }

    $updatedProducts = $this->putProducts($productProvider, $editedProducts);
    $this->assertEquals($editedProducts, $updatedProducts);

    $getQuery = new AllQuery();
    $resultingProducts = $productProvider->provideGetAllInteractor()($getQuery);

    $this->assertEquals($editedProducts, $resultingProducts);
  }

  public function testDeleteProductInteractor(): void {
    [
      $productProvider,
      $product,
      $createdProduct,
    ] = $this->createAndGetProduct();

    $deleteQuery = new IdQuery((string) $createdProduct->id);
    $productProvider->provideDeleteInteractor()($deleteQuery);

    $getQuery = new IdQuery((string) $createdProduct->id);

    $this->expectException(DataNotFoundException::class);
    $productProvider->provideGetInteractor()($getQuery);
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
    $query = new IdQuery((string) $product->id);

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

  /**
   * @return array{ProductProvider, Product, Product}
   */
  protected function createAndGetProduct(): array {
    $productProvider = $this->getProvider();
    $product = $this->getProductOne();
    $createdProduct = $this->putProduct($productProvider, $product);
    return [$productProvider, $product, $createdProduct];
  }

  /**
   * @return array{ProductProvider, Product[], Product[]}
   */
  protected function createAndGetProducts(): array {
    $productProvider = $this->getProvider();
    $products = $this->getListOfProducts();
    $createdProducts = $this->putProducts($productProvider, $products);
    return [$productProvider, $products, $createdProducts];
  }
}
