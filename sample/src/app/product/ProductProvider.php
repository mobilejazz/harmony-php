<?php

namespace Sample\product;

use harmony\core\domain\interactor\DeleteInteractor;
use harmony\core\domain\interactor\GetAllInteractor;
use harmony\core\domain\interactor\GetInteractor;
use harmony\core\domain\interactor\PutAllInteractor;
use harmony\core\domain\interactor\PutInteractor;
use harmony\core\repository\datasource\DataSourceMapper;
use harmony\core\repository\datasource\InMemoryDataSource;
use harmony\core\repository\Repository;
use harmony\core\repository\RepositoryMapper;
use harmony\core\repository\SingleDataSourceRepository;
use Sample\product\data\datasource\inMemory\mapper\ProductEntityToInMemoryMapper;
use Sample\product\data\datasource\inMemory\mapper\ProductInMemoryToEntityMapper;
use Sample\product\data\datasource\inMemory\model\ProductInMemory;
use Sample\product\data\entity\ProductEntity;
use Sample\product\data\mapper\ProductEntityToModelMapper;
use Sample\product\data\mapper\ProductModelToEntityMapper;
use Sample\product\domain\model\Product;

class ProductProvider
{
    protected $di_container = [];

    protected const KEY_PRODUCT_REPOSITORY = 'ProductRepository';

    /**
     * @return RepositoryMapper
     */
    protected function registerRepository(): RepositoryMapper
    {
        $productInMemoryDataSource = new InMemoryDataSource(ProductInMemory::class);

        $productEntityToInMemoryMapper = new ProductEntityToInMemoryMapper(
            ProductEntity::class,
            ProductInMemory::class
        );
        $productInMemoryToEntityMapper = new ProductInMemoryToEntityMapper(
            ProductInMemory::class,
            ProductEntity::class
        );

        $productEntityDataSourceMapper = new DataSourceMapper(
            $productInMemoryDataSource,
            $productInMemoryDataSource,
            $productInMemoryDataSource,
            $productEntityToInMemoryMapper,
            $productInMemoryToEntityMapper
        );

        $productRepository = new SingleDataSourceRepository(
            $productEntityDataSourceMapper,
            $productEntityDataSourceMapper,
            $productEntityDataSourceMapper
        );

        $productModelToEntityMapper = new ProductModelToEntityMapper(
            Product::class,
            ProductEntity::class
        );
        $productEntityToModelMapper = new ProductEntityToModelMapper(
            ProductEntity::class,
            Product::class
        );

        $productRepositoryMapper = new RepositoryMapper(
            $productRepository,
            $productRepository,
            $productRepository,
            $productModelToEntityMapper,
            $productEntityToModelMapper
        );

        return $productRepositoryMapper;
    }

    /**
     * @return Repository
     */
    public function getProductRepository(): Repository
    {
        if (empty($this->di_container[self::KEY_PRODUCT_REPOSITORY])) {
            $this->di_container[self::KEY_PRODUCT_REPOSITORY] = $this->registerRepository();
        }

        return $this->di_container[self::KEY_PRODUCT_REPOSITORY];
    }

    /**
     * @return GetInteractor
     */
    public function getGetInteractor(): GetInteractor
    {
        return new GetInteractor($this->getProductRepository());
    }

    /**
     * @return GetAllInteractor
     */
    public function getGetAllInteractor(): GetAllInteractor
    {
        return new GetAllInteractor($this->getProductRepository());
    }

    /**
     * @return PutInteractor
     */
    public function getPutInteractor(): PutInteractor
    {
        return new PutInteractor($this->getProductRepository());
    }

    /**
     * @return PutAllInteractor
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
