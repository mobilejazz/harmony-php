<?php

namespace Sample\Product;

use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Repository\RepositoryMapper;
use Harmony\Core\Data\Repository\SingleDataSourceRepository;
use Harmony\Core\Domain\Interactor\DeleteInteractor;
use Harmony\Core\Domain\Interactor\GetInteractor;
use Harmony\Core\Domain\Interactor\PutInteractor;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;
use Sample\Product\Data\Mapper\ProductToProductEntityMapper;
use Sample\Product\Domain\Model\Product;

class ProductProvider {
  /** @var RepositoryMapper<Product, Product, ProductEntity> */
  protected RepositoryMapper $productRepository;
  /** @var RepositoryMapper<Product[], Product, ProductEntity> */
  protected RepositoryMapper $arrayProductRepository;

  /**
   * @param GetDataSource&PutDataSource&DeleteDataSource $dataSource
   * @param GetDataSource&PutDataSource&DeleteDataSource $arrayDataSource
   */
  // @phpstan-ignore-next-line
  public function __construct(mixed $dataSource, mixed $arrayDataSource) {
    /** @var RepositoryMapper<Product, Product, ProductEntity> */
    $singleRepository = $this->provideRepository($dataSource);
    $this->productRepository = $singleRepository;

    /** @var RepositoryMapper<Product[], Product, ProductEntity> */
    $arrayRepository = $this->provideRepository($arrayDataSource);
    $this->arrayProductRepository = $arrayRepository;
  }

  /**
   * @param GetDataSource&PutDataSource&DeleteDataSource $dataSource
   *
   * @return RepositoryMapper<Product, Product, ProductEntity>|RepositoryMapper<Product[], Product, ProductEntity>
   *
   * @psalm-suppress InvalidArgument
   */
  // @phpstan-ignore-next-line
  protected function provideRepository(mixed $dataSource): RepositoryMapper {
    $repository = new SingleDataSourceRepository(
      $dataSource,
      $dataSource,
      $dataSource,
    );

    $productRepository = new RepositoryMapper(
      $repository,
      $repository,
      $repository,
      // @phpstan-ignore-next-line
      new ProductToProductEntityMapper(),
      // @phpstan-ignore-next-line
      new ProductEntityToProductMapper(),
    );

    // @phpstan-ignore-next-line
    return $productRepository;
  }

  /**
   * @return GetInteractor<Product>
   */
  public function provideGetInteractor(): GetInteractor {
    return new GetInteractor($this->productRepository);
  }

  /**
   * @return GetInteractor<Product[]>
   */
  public function provideGetAllInteractor(): GetInteractor {
    return new GetInteractor($this->arrayProductRepository);
  }

  /**
   * @return PutInteractor<Product>
   */
  public function providePutInteractor(): PutInteractor {
    return new PutInteractor($this->productRepository);
  }

  /**
   * @return PutInteractor<Product[]>
   */
  public function providePutAllInteractor(): PutInteractor {
    return new PutInteractor($this->arrayProductRepository);
  }

  /**
   * @return DeleteInteractor
   */
  public function provideDeleteInteractor(): DeleteInteractor {
    return new DeleteInteractor($this->productRepository);
  }
}
