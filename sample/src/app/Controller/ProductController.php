<?php

namespace Sample\Controller;

use Harmony\Core\Repository\Operation\DefaultOperation;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use Sample\Product\Domain\Interactor\DeleteProductInteractor;
use Sample\Product\Domain\Interactor\GetAllProductInteractor;
use Sample\Product\Domain\Interactor\GetProductInteractor;
use Sample\Product\Domain\Interactor\PutAllProductInteractor;
use Sample\Product\Domain\Interactor\PutProductInteractor;
use Sample\Product\Domain\Model\Product;

class ProductController {
  public function __construct(
    protected GetProductInteractor $getProductInteractor,
    protected GetAllProductInteractor $getAllProductInteractor,
    protected PutProductInteractor $putProductInteractor,
    protected PutAllProductInteractor $putAllProductInteractor,
    protected DeleteProductInteractor $deleteProductInteractor
  ) {
  }

  /**
   * @return false|string
   */
  public function actionIndex() {
    $productOne = new Product(1, 'PlayStation 5', 'VideoGames Console from Sony.', 599.99);

    $productTwo = new Product(2, 'XBox X', 'VideoGames Console from Microsoft', 450.5);

    $listProducts = [$productOne, $productTwo];

    $variables = [];

    $variables['resultPutProductAction'] = $this->putProductAction($productOne);
    $variables['resultGetProductAction'] = $this->getProductAction($productOne->getId());
    $variables['resultPutAllProductAction'] = $this->putAllProductsAction($listProducts);
    $variables['resultGetAllProductAction'] = $this->getAllProductsAction();
    $variables['resultDeleteProductAction'] = $this->deleteProductAction($productOne->getId());

    return $this->renderView($variables, 'index');
  }

  /**
   * @param Product $product
   *
   * @return Product
   */
  protected function putProductAction(Product $product): Product {
    $query = new KeyQuery((string) $product->getId());

    return ($this->putProductInteractor)($product, $query);
  }

  /**
   * @param int $id_product
   *
   * @return Product
   */
  protected function getProductAction(int $id_product): Product {
    $query = new KeyQuery((string) $id_product);
    $product = ($this->getProductInteractor)($query);

    return $product;
  }

  /**
   * @param array<Product> $products
   *
   * @return array<Product>
   */
  protected function putAllProductsAction(array $products): array {
    $query = new AllQuery();
    $result = ($this->putAllProductInteractor)($products, $query);

    return $result;
  }

  /**
   * @return Product[]
   */
  protected function getAllProductsAction(): array {
    $query = new AllQuery();
    $products = ($this->getAllProductInteractor)($query);

    return $products;
  }

  /**
   * @param int $id_product
   *
   * @return string
   */
  protected function deleteProductAction(int $id_product): string {
    $query = new KeyQuery((string) $id_product);
    ($this->deleteProductInteractor)($query);

    return 'deleted';
  }

  /**
   * @param array<string, mixed> $variables
   * @param string               $template
   *
   * @return false|string
   */
  protected function renderView(array $variables, string $template) {
    ob_start();

    extract($variables, EXTR_OVERWRITE);

    $template_path = __DIR__ . '/../views/' . $template . '.template.view';

    if (file_exists($template_path)) {
      include $template_path;
    }

    $result = ob_get_clean();

    return $result;
  }
}
