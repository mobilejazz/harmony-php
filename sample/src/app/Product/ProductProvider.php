<?php

namespace Sample\Product;

use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Mapper\ArrayMapper;
use Harmony\Core\Data\Repository\RepositoryMapper;
use Harmony\Core\Data\Repository\RepositoryProvider;
use Harmony\Core\Domain\Interactor\DeleteInteractor;
use Harmony\Core\Domain\Interactor\GetInteractor;
use Harmony\Core\Domain\Interactor\PutInteractor;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;
use Sample\Product\Data\Mapper\ProductToProductEntityMapper;
use Sample\Product\Domain\Model\Product;

class ProductProvider {
  /** @var RepositoryMapper<Product, ProductEntity> */
  protected RepositoryMapper $productRepository;
  /** @var RepositoryMapper<Product[], ProductEntity[]> */
  protected RepositoryMapper $arrayProductRepository;

  /**
   * @param GetDataSource&PutDataSource&DeleteDataSource $dataSource
   * @param GetDataSource&PutDataSource&DeleteDataSource $arrayDataSource
   */
  // @phpstan-ignore-next-line
  public function __construct(mixed $dataSource, mixed $arrayDataSource) {
    $this->productRepository = RepositoryProvider::singleRepositoryMapper(
      singleDataSource: $dataSource,
      modelToEntityMapper: new ProductToProductEntityMapper(),
      entityToModelMapper: new ProductEntityToProductMapper(),
    );

    $this->arrayProductRepository = RepositoryProvider::singleRepositoryMapper(
      singleDataSource: $arrayDataSource,
      modelToEntityMapper: new ArrayMapper(new ProductToProductEntityMapper()),
      entityToModelMapper: new ArrayMapper(new ProductEntityToProductMapper()),
    );
  }

  /**
   * @return GetInteractor<Product>
   */
  public function provideGetInteractor(): GetInteractor {
    /** @var GetInteractor<Product> */
    return new GetInteractor($this->productRepository);
  }

  /**
   * @return GetInteractor<Product[]>
   */
  public function provideGetAllInteractor(): GetInteractor {
    /** @var GetInteractor<Product[]> */
    return new GetInteractor($this->arrayProductRepository);
  }

  /**
   * @return PutInteractor<Product>
   */
  public function providePutInteractor(): PutInteractor {
    /** @var PutInteractor<Product> */
    return new PutInteractor($this->productRepository);
  }

  /**
   * @return PutInteractor<Product[]>
   */
  public function providePutAllInteractor(): PutInteractor {
    /** @var PutInteractor<Product[]> */
    return new PutInteractor($this->arrayProductRepository);
  }

  /**
   * @return DeleteInteractor
   */
  public function provideDeleteInteractor(): DeleteInteractor {
    return new DeleteInteractor($this->productRepository);
  }
}
