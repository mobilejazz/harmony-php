<?php

namespace Sample\Product\Controller;

use Harmony\Core\Domain\Interactor\DeleteInteractor;
use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Harmony\Core\Domain\Interactor\GetInteractor;
use Harmony\Core\Domain\Interactor\PutAllInteractor;
use Harmony\Core\Domain\Interactor\PutInteractor;
use Harmony\Core\Module\Router\ControllerActionInterface;
use Harmony\Core\Repository\Operation\DefaultOperation;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use Sample\Product\Domain\Model\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductAction implements ControllerActionInterface {
  /**
   * @param GetInteractor<Product>    $getProductInteractor
   * @param GetAllInteractor<Product> $getAllProductInteractor
   * @param PutInteractor<Product>    $putProductInteractor
   * @param PutAllInteractor<Product> $putAllProductInteractor
   * @param DeleteInteractor<Product> $deleteProductInteractor
   */
  public function __construct(
    protected GetInteractor $getProductInteractor,
    protected GetAllInteractor $getAllProductInteractor,
    protected PutInteractor $putProductInteractor,
    protected PutAllInteractor $putAllProductInteractor,
    protected DeleteInteractor $deleteProductInteractor,
  ) {
  }

  public function __invoke(Request $request): Response {
    $response = new Response($this->render(), Response::HTTP_OK, [
      "content-type" => "text/html",
    ]);

    return $response;
  }

  public function render(): ?string {
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

    return ($this->putProductInteractor)($product, $query);
  }

  protected function getProductAction(int $id_product): Product {
    $query = new KeyQuery((string) $id_product);
    $product = ($this->getProductInteractor)($query);

    return $product;
  }

  /**
   * @param Product[] $products
   *
   * @return Product[]
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

  protected function deleteProductAction(int $id_product): string {
    $query = new KeyQuery((string) $id_product);
    ($this->deleteProductInteractor)($query);

    return "deleted";
  }

  /**
   * @param array<string, mixed> $variables
   * @param string               $template
   *
   * @return string|null
   */
  protected function renderView(array $variables, string $template): ?string {
    $template_path = __DIR__ . "/../views/" . $template . ".template.view";

    if (file_exists($template_path)) {
      ob_start();
      extract($variables, EXTR_OVERWRITE);
      include $template_path;
      $result = ob_get_clean();
    }

    return isset($result) && is_string($result) ? $result : null;
  }
}
