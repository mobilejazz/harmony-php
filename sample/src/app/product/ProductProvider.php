<?php

namespace Sample\product;

use harmony\core\repository\datasource\InMemoryDataSource;
use harmony\core\repository\RepositoryMapper;
use harmony\core\repository\SingleDataSourceRepository;
use Sample\product\data\entity\ProductEntity;
use Sample\product\data\mapper\ProductEntityToProductMapper;
use Sample\product\data\mapper\ProductToProductEntityMapper;
use Sample\product\domain\interactor\DeleteProductInteractor;
use Sample\product\domain\interactor\GetAllProductInteractor;
use Sample\product\domain\interactor\GetProductInteractor;
use Sample\product\domain\interactor\PutAllProductInteractor;
use Sample\product\domain\interactor\PutProductInteractor;
use Sample\product\domain\model\Product;

class ProductProvider
{
    /** @var string */
    protected const KEY_PRODUCT_REPOSITORY = 'ProductRepository';

    /** @var array<string, mixed> */
    protected $di_container = [];

    /**
     * @return RepositoryMapper<Product, ProductEntity>
     */
    protected function registerRepository(): RepositoryMapper
    {
        $productInMemoryDataSource = new InMemoryDataSource(ProductEntity::class);

        $productRepository = new SingleDataSourceRepository(
            $productInMemoryDataSource,
            $productInMemoryDataSource,
            $productInMemoryDataSource,
        );

        $productRepositoryMapper = new RepositoryMapper(
            $productRepository,
            $productRepository,
            $productRepository,
            new ProductToProductEntityMapper(),
            new ProductEntityToProductMapper(),
        );

        return $productRepositoryMapper;
    }

    /**
     * @return RepositoryMapper<Product, ProductEntity>
     */
    public function getProductRepository(): RepositoryMapper
    {
        if (empty($this->di_container[self::KEY_PRODUCT_REPOSITORY])) {
            $this->di_container[self::KEY_PRODUCT_REPOSITORY] = $this->registerRepository();
        }

        return $this->di_container[self::KEY_PRODUCT_REPOSITORY];
    }

    /**
     * @return GetProductInteractor
     */
    public function getGetInteractor(): GetProductInteractor
    {
        return new GetProductInteractor($this->getProductRepository());
    }

    /**
     * @return GetAllProductInteractor
     */
    public function getGetAllInteractor(): GetAllProductInteractor
    {
        return new GetAllProductInteractor($this->getProductRepository());
    }

    /**
     * @return PutProductInteractor
     */
    public function getPutInteractor(): PutProductInteractor
    {
        return new PutProductInteractor($this->getProductRepository());
    }

    /**
     * @return PutAllProductInteractor
     */
    public function getPutAllInteractor(): PutAllProductInteractor
    {
        return new PutAllProductInteractor($this->getProductRepository());
    }

    /**
     * @return DeleteProductInteractor
     */
    public function getDeleteInteractor(): DeleteProductInteractor
    {
        return new DeleteProductInteractor($this->getProductRepository());
    }
}
