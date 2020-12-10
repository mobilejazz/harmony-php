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

class ProductController
{
    /** @var GetProductInteractor */
    protected $getProductInteractor;
    /** @var GetAllProductInteractor */
    protected $getAllProductInteractor;
    /** @var PutProductInteractor */
    protected $putProductInteractor;
    /** @var PutAllProductInteractor */
    protected $putAllProductInteractor;
    /** @var DeleteProductInteractor */
    protected $deleteProductInteractor;

    /**
     * @param GetProductInteractor    $getInteractor
     * @param GetAllProductInteractor $getAllInteractor
     * @param PutProductInteractor    $putInteractor
     * @param PutAllProductInteractor $putAllInteractor
     * @param DeleteProductInteractor $deleteInteractor
     */
    public function __construct(
        GetProductInteractor $getInteractor,
        GetAllProductInteractor $getAllInteractor,
        PutProductInteractor $putInteractor,
        PutAllProductInteractor $putAllInteractor,
        DeleteProductInteractor $deleteInteractor
    ) {
        $this->getProductInteractor = $getInteractor;
        $this->getAllProductInteractor = $getAllInteractor;
        $this->putProductInteractor = $putInteractor;
        $this->putAllProductInteractor = $putAllInteractor;
        $this->deleteProductInteractor = $deleteInteractor;
    }

    /**
     * @return false|string
     */
    public function actionIndex()
    {
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
    protected function putProductAction(Product $product): Product
    {
        $query = new KeyQuery((string) $product->getId());

        return $this->putProductInteractor->execute($query, new DefaultOperation(), $product);
    }

    /**
     * @param int $id_product
     *
     * @return Product
     */
    protected function getProductAction(int $id_product): Product
    {
        $query = new KeyQuery((string) $id_product);
        $product = $this->getProductInteractor->execute($query, new DefaultOperation());

        return $product;
    }

    /**
     * @param array<Product> $products
     *
     * @return array<Product>
     */
    protected function putAllProductsAction(array $products): array
    {
        $query = new AllQuery();
        $result = $this->putAllProductInteractor->execute($query, new DefaultOperation(), $products);

        return $result;
    }

    /**
     * @return Product[]
     */
    protected function getAllProductsAction(): array
    {
        $query = new AllQuery();
        $products = $this->getAllProductInteractor->execute($query, new DefaultOperation());

        return $products;
    }

    /**
     * @param int $id_product
     *
     * @return string
     */
    protected function deleteProductAction(int $id_product): string
    {
        $query = new KeyQuery((string) $id_product);
        $this->deleteProductInteractor->execute($query, new DefaultOperation());

        return 'deleted';
    }

    /**
     * @param array<string, mixed> $variables
     * @param string               $template
     *
     * @return false|string
     */
    protected function renderView(array $variables, string $template)
    {
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
