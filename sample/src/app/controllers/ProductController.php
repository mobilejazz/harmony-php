<?php

namespace Sample\controllers;

use harmony\core\domain\interactor\DeleteInteractor;
use harmony\core\domain\interactor\GetAllInteractor;
use harmony\core\domain\interactor\GetInteractor;
use harmony\core\domain\interactor\PutAllInteractor;
use harmony\core\domain\interactor\PutInteractor;
use harmony\core\repository\operation\DefaultOperation;
use harmony\core\repository\query\KeyQuery;
use harmony\core\shared\collection\GenericCollection;
use Sample\product\domain\model\Product;

class ProductController
{
    /**
     * @var GetInteractor
     */
    protected $getInteractor;
    /**
     * @var GetAllInteractor
     */
    protected $getAllInteractor;
    /**
     * @var PutInteractor
     */
    protected $putInteractor;
    /**
     * @var PutAllInteractor
     */
    protected $putAllInteractor;
    /**
     * @var DeleteInteractor
     */
    protected $deleteInteractor;

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
            'indexTemplate'
        );
    }

    /**
     * @param $product
     *
     * @return \harmony\core\domain\Model|\harmony\core\repository\BaseEntity
     */
    protected function putProductAction(Product $product)
    {
        $query = new KeyQuery((string)$product->getId());

        return $this->putInteractor->execute(
            $query,
            new DefaultOperation(),
            $product
        );
    }

    /**
     * @param string $id_product
     *
     * @return \harmony\core\repository\BaseEntity
     */
    protected function getProductAction(string $id_product)
    {
        $query = new KeyQuery($id_product);
        $product = $this->getInteractor->execute(
            $query,
            new DefaultOperation()
        );

        return $product;
    }

    /**
     * @param GenericCollection $products
     *
     * @return GenericCollection
     */
    protected function putAllProductsAction(GenericCollection $products): GenericCollection
    {
        $query = new KeyQuery('myproducts');
        $products = $this->putAllInteractor->execute(
            $query,
            new DefaultOperation(),
            $products
        );

        return $products;
    }

    /**
     * @return GenericCollection
     */
    protected function getAllProductsAction(): GenericCollection
    {
        $query = new KeyQuery('myproducts');
        $products = $this->getAllInteractor->execute(
            $query,
            new DefaultOperation()
        );

        return $products;
    }

    /**
     * @param string $id_product
     *
     * @return string
     */
    protected function deleteProductAction(string $id_product): string
    {
        $query = new KeyQuery($id_product);
        $this->deleteInteractor->execute(
            $query,
            new DefaultOperation()
        );

        return 'deleted';
    }

    /**
     * @param array  $variables
     * @param string $template
     *
     * @return false|string
     */
    protected function renderView(array $variables, string $template)
    {
        ob_start();

        extract($variables, null);
        include __DIR__ . '/../views/' . $template . '.php';

        $result = ob_get_clean();

        return $result;
    }
}
