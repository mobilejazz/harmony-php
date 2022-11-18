<?php

namespace Sample\Application;

use Harmony\Core\Domain\Interactor\DeleteInteractor;
use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Harmony\Core\Domain\Interactor\GetInteractor;
use Harmony\Core\Domain\Interactor\PutAllInteractor;
use Harmony\Core\Domain\Interactor\PutInteractor;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use Sample\Product\Domain\Model\Product;

class ProductIndexAction {
  public function __construct(
    /** @var GetInteractor<Product> $getProduct */
    protected readonly GetInteractor $getProduct,
    /** @var GetAllInteractor<Product> $getAllProduct */
    protected readonly GetAllInteractor $getAllProduct,
    /** @var PutInteractor<Product> $putProduct */
    protected readonly PutInteractor $putProduct,
    /** @var PutAllInteractor<Product> $putAllProduct */
    protected readonly PutAllInteractor $putAllProduct,
    /** @var DeleteInteractor<Product> $deleteProduct */
    protected readonly DeleteInteractor $deleteProduct,
  ) {
  }

  public function __invoke(): bool|string {
    $productOne = new Product(
      1,
      "PlayStation 5",
      "VideoGames Console from Sony.",
      599.99,
    );

    $productTwo = new Product(
      2,
      "XBox X",
      "VideoGames Console from Microsoft",
      450.5,
    );

    $listProducts = [$productOne, $productTwo];

    $variables = [];

    $variables["resultPutProductAction"] = $this->putProductAction($productOne);
    $variables["resultGetProductAction"] = $this->getProductAction(
      $productOne->id,
    );
    $variables["resultPutAllProductAction"] = $this->putAllProductsAction(
      $listProducts,
    );
    $variables["resultGetAllProductAction"] = $this->getAllProductsAction();
    $variables["resultDeleteProductAction"] = $this->deleteProductAction(
      $productOne->id,
    );

    return $this->renderView($variables, "index");
  }

  protected function putProductAction(Product $product): Product {
    $query = new KeyQuery((string) $product->id);

    return ($this->putProduct)($product, $query);
  }

  protected function getProductAction(int $id): Product {
    $query = new KeyQuery((string) $id);
    $product = ($this->getProduct)($query);

    return $product;
  }

  /**
   * @param Product[] $products
   *
   * @return Product[]
   */
  protected function putAllProductsAction(array $products): array {
    $query = new AllQuery();
    $result = ($this->putAllProduct)($products, $query);

    return $result;
  }

  /**
   * @return Product[]
   */
  protected function getAllProductsAction(): array {
    $query = new AllQuery();
    $products = ($this->getAllProduct)($query);

    return $products;
  }

  protected function deleteProductAction(int $id): string {
    $query = new KeyQuery((string) $id);
    ($this->deleteProduct)($query);

    return "deleted";
  }

  /**
   * @param array<string, mixed> $variables
   * @param string               $template
   */
  protected function renderView(
    array $variables,
    string $template,
  ): bool|string {
    ob_start();

    extract($variables, EXTR_OVERWRITE);

    $templatePath = __DIR__ . "/../views/" . $template . ".template.view";

    if (file_exists($templatePath)) {
      include $templatePath;
    }

    $result = ob_get_clean();

    return $result;
  }
}
