<?php

namespace Sample\controllers;

use harmony\core\repository\operation\DefaultOperation;
use harmony\core\repository\query\AllQuery;
use harmony\core\repository\query\KeyQuery;
use Sample\product\domain\interactor\DeleteProductInteractor;
use Sample\product\domain\interactor\GetAllProductInteractor;
use Sample\product\domain\interactor\GetProductInteractor;
use Sample\product\domain\interactor\PutAllProductInteractor;
use Sample\product\domain\interactor\PutProductInteractor;
use Sample\product\domain\model\Product;

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

    return ($this->putProductInteractor)($query, new DefaultOperation(), $product);
  }

  /**
   * @param int $id_product
   *
   * @return Product
   */
  protected function getProductAction(int $id_product): Product {
    $query = new KeyQuery((string) $id_product);
    $product = ($this->getProductInteractor)($query, new DefaultOperation());

    return $product;
  }

  /**
   * @param array<Product> $products
   *
   * @return array<Product>
   */
  protected function putAllProductsAction(array $products): array {
    $query = new AllQuery();
    $result = ($this->putAllProductInteractor)($query, new DefaultOperation(), $products);

    return $result;
  }

  /**
   * @return Product[]
   */
  protected function getAllProductsAction(): array {
    $query = new AllQuery();
    $products = ($this->getAllProductInteractor)($query, new DefaultOperation());

    return $products;
  }

  /**
   * @param int $id_product
   *
   * @return string
   */
  protected function deleteProductAction(int $id_product): string {
    $query = new KeyQuery((string) $id_product);
    ($this->deleteProductInteractor)($query, new DefaultOperation());

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
