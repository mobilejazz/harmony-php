<?php

namespace Sample\product;

use harmony\core\domain\interactor\DeleteInteractor;
use harmony\core\domain\interactor\GetAllInteractor;
use harmony\core\domain\interactor\GetInteractor;
use harmony\core\domain\interactor\PutAllInteractor;
use harmony\core\domain\interactor\PutInteractor;
use harmony\core\repository\datasource\InMemoryDataSource;
use harmony\core\repository\RepositoryMapper;
use harmony\core\repository\SingleDataSourceRepository;
use Sample\product\data\entity\ProductEntity;
use Sample\product\data\mapper\ProductEntityToProductMapper;
use Sample\product\data\mapper\ProductToProductEntityMapper;
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
            $productInMemoryDataSource
        );

        $productRepositoryMapper = new RepositoryMapper(
            $productRepository,
            $productRepository,
            $productRepository,
            new ProductToProductEntityMapper(),
            new ProductEntityToProductMapper()
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
     * @return GetInteractor<Product>
     */
    public function getGetInteractor(): GetInteractor
    {
        return new GetInteractor($this->getProductRepository());
    }

    /**
     * @return GetAllInteractor<Product>
     */
    public function getGetAllInteractor(): GetAllInteractor
    {
        return new GetAllInteractor($this->getProductRepository());
    }

    /**
     * @return PutInteractor<Product>
     */
    public function getPutInteractor(): PutInteractor
    {
        return new PutInteractor($this->getProductRepository());
    }

    /**
     * @return PutAllInteractor<Product>
     */
    public function getPutAllInteractor(): PutAllInteractor
    {
        return new PutAllInteractor($this->getProductRepository());
    }

    /**
     * @return DeleteInteractor
     */
    public function getDeleteInteractor(): DeleteInteractor
    {
        return new DeleteInteractor($this->getProductRepository());
    }
}
