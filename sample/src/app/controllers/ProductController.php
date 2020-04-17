<?php

namespace Sample\controllers;

use harmony\core\domain\interactor\DeleteInteractor;
use harmony\core\domain\interactor\GetAllInteractor;
use harmony\core\domain\interactor\GetInteractor;
use harmony\core\domain\interactor\PutAllInteractor;
use harmony\core\domain\interactor\PutInteractor;
use harmony\core\repository\operation\DefaultOperation;
use harmony\core\repository\query\AllQuery;
use harmony\core\repository\query\KeyQuery;
use harmony\core\shared\collection\GenericCollection;
use Sample\product\domain\model\Product;

class ProductController
{
    /** @var GetInteractor<Product> */
    protected $getInteractor;
    /** @var GetAllInteractor<Product> */
    protected $getAllInteractor;
    /** @var PutInteractor<Product> */
    protected $putInteractor;
    /** @var PutAllInteractor<Product> */
    protected $putAllInteractor;
    /** @var DeleteInteractor */
    protected $deleteInteractor;

    /**
     * @param GetInteractor<Product>    $getInteractor
     * @param GetAllInteractor<Product> $getAllInteractor
     * @param PutInteractor<Product>    $putInteractor
     * @param PutAllInteractor<Product> $putAllInteractor
     * @param DeleteInteractor          $deleteInteractor
     */
    public function __construct(
        GetInteractor $getInteractor,
        GetAllInteractor $getAllInteractor,
        PutInteractor $putInteractor,
        PutAllInteractor $putAllInteractor,
        DeleteInteractor $deleteInteractor
    ) {
        $this->getInteractor = $getInteractor;
        $this->getAllInteractor = $getAllInteractor;
        $this->putInteractor = $putInteractor;
        $this->putAllInteractor = $putAllInteractor;
        $this->deleteInteractor = $deleteInteractor;
    }

    /**
     * @return false|string
     */
    public function actionIndex()
    {
        $productOne = new Product(
            1,
            'PlayStation 5',
            'VideoGames Console from Sony.',
            599.99
        );

        $productTwo = new Product(
            2,
            'XBox X',
            'VideoGames Console from Microsoft',
            450.50
        );

        $listProducts = new GenericCollection(
            Product::class,
            [
                $productOne,
                $productTwo,
            ]
        );

        $variables = [];

        $variables['resultPutProductAction'] = $this->putProductAction($productOne);
        $variables['resultGetProductAction'] = $this->getProductAction($productOne->getId());
        $variables['resultPutAllProductAction'] = $this->putAllProductsAction($listProducts);
        $variables['resultGetAllProductAction'] = $this->getAllProductsAction();
        $variables['resultDeleteProductAction'] = $this->deleteProductAction($productOne->getId());

        return $this->renderView(
            $variables,
            'index'
        );
    }

    /**
     * @param Product $product
     *
     * @return Product
     */
    protected function putProductAction(Product $product): Product
    {
        $query = new KeyQuery((string)$product->getId());

        return $this->putInteractor->execute(
            $query,
            new DefaultOperation(),
            $product
        );
    }

    /**
     * @param int $id_product
     *
     * @return Product
     */
    protected function getProductAction(int $id_product): Product
    {
        $query = new KeyQuery((string)$id_product);
        $product = $this->getInteractor->execute(
            $query,
            new DefaultOperation()
        );

        return $product;
    }

    /**
     * @param GenericCollection<Product> $products
     *
     * @return GenericCollection<Product>
     */
    protected function putAllProductsAction(GenericCollection $products): GenericCollection
    {
        $query = new AllQuery();
        $result = $this->putAllInteractor->execute(
            $query,
            new DefaultOperation(),
            $products
        );

        return $result;
    }

    /**
     * @return GenericCollection<Product>
     */
    protected function getAllProductsAction(): GenericCollection
    {
        $query = new AllQuery();
        $products = $this->getAllInteractor->execute(
            $query,
            new DefaultOperation()
        );

        return $products;
    }

    /**
     * @param int $id_product
     *
     * @return string
     */
    protected function deleteProductAction(int $id_product): string
    {
        $query = new KeyQuery((string)$id_product);
        $this->deleteInteractor->execute(
            $query,
            new DefaultOperation()
        );

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
