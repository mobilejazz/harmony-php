<?php

namespace Sample\product;

use harmony\core\domain\interactor\DeleteInteractor;
use harmony\core\domain\interactor\GetAllInteractor;
use harmony\core\domain\interactor\GetInteractor;
use harmony\core\domain\interactor\PutAllInteractor;
use harmony\core\domain\interactor\PutInteractor;
use harmony\core\repository\datasource\DataSourceMapper;
use harmony\core\repository\datasource\InMemoryDataSource;
use harmony\core\repository\RepositoryMapper;
use harmony\core\repository\SingleDataSourceRepository;
use Sample\product\domain\model\Product;

class ProductProvider
{
    /**
     * @return RepositoryMapper
     */
    public function registerRepository(): RepositoryMapper
    {
        $productInMemoryDataSource = new InMemoryDataSource(Product::class);

        $productEntityToInMemoryMapper = null;
        $productInMemoryToEntityMapper = null;

        $productEntityDataSourceMapper = new DataSourceMapper(
            $productInMemoryDataSource,
            $productInMemoryDataSource,
            $productInMemoryDataSource,
            $productEntityDataSourceMapper,
            $productInMemoryToEntityMapper
        );

        $productRepository = new SingleDataSourceRepository(
            $productEntityDataSourceMapper,
            $productEntityDataSourceMapper,
            $productEntityDataSourceMapper
        );

        $productModelToEntityMapper = null;
        $productEntityToModelMapper = null;

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
     * @return GetInteractor
     */
    public function registerGetInteractor(): GetInteractor
    {
        return new GetInteractor($this->registerRepository());
    }

    /**
     * @return GetAllInteractor
     */
    public function registerGetAllInteractor(): GetAllInteractor
    {
        return new GetAllInteractor($this->registerRepository());
    }

    /**
     * @return PutInteractor
     */
    public function registerPutInteractor(): PutInteractor
    {
        return new PutInteractor($this->registerRepository());
    }

    /**
     * @return PutAllInteractor
     */
    public function registerPutAllInteractor(): PutAllInteractor
    {
        return new PutAllInteractor($this->registerRepository());
    }

    /**
     * @return DeleteInteractor
     */
    public function registerDeleteInteractor(): DeleteInteractor
    {
        return new DeleteInteractor($this->registerRepository());
    }
}
