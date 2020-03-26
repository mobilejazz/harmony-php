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

class ProductProvider
{
    protected const KEY_PRODUCT_REPOSITORY = 'ProductRepository';

    protected $di_container = [];

    /**
     * @return RepositoryMapper
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
     * @return RepositoryMapper
     */
    public function getProductRepository(): RepositoryMapper
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
