<?php

namespace App\Tests\unit\Sample\Product\Domain\Interactor;

use Harmony\Core\Repository\Error\DataNotFoundException;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use PHPUnit\Framework\TestCase;
use Sample\Product\Domain\Model\Product;
use Sample\Product\ProductModule;

class ProductInteractorsTest extends TestCase {
  private ProductModule $productProvider;

  public function setUp(): void {
    $this->productProvider = new ProductModule();
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

  public function putProduct(Product $product): Product {
    $query = new KeyQuery((string) $product->id);

    return $this->productProvider->getPutInteractor()($product, $query);
  }

  /**
   * @param Product[] $products
   *
   * @return Product[]
   */
  public function putProducts(array $products): array {
    $query = new AllQuery();

    return $this->productProvider->getPutAllInteractor()($products, $query);
  }

  public function testPutProductInteractor(): void {
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($product);

    $this->assertEquals($productSaved->name, $product->name);
  }

  public function testGetProductInteractor(): void {
    $product = $this->getProductOne();
    $productSaved = $this->putProduct($product);

    $queryGet = new KeyQuery((string) $productSaved->id);

    $this->productProvider->getGetInteractor()($queryGet);

    $this->assertEquals($productSaved->name, $product->name);
  }

  public function testPutAllProductsInteractor(): void {
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($products);

    $this->assertEquals($products, $productsSaved);
  }

  public function testGetAllProductsInteractor(): void {
    $products = $this->getListOfProducts();
    $productsSaved = $this->putProducts($products);

    $getQuery = new AllQuery();
    $allProducts = $this->productProvider->getGetAllInteractor()($getQuery);

    $this->assertEquals($productsSaved, $allProducts);
  }

  public function testDeleteProductInteractor(): void {
    $this->expectException(DataNotFoundException::class);

    $product = $this->getProductOne();
    $productSaved = $this->putProduct($product);

    $queryDelete = new KeyQuery((string) $productSaved->id);
    $this->productProvider->getDeleteInteractor()($queryDelete);

    $queryGet = new KeyQuery((string) $productSaved->id);
    $this->productProvider->getGetInteractor()($queryGet);
  }
}
