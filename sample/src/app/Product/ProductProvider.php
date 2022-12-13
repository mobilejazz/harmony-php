<?php

namespace Sample\Product;

use Harmony\Core\Domain\Interactor\DeleteInteractor;
use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Harmony\Core\Domain\Interactor\GetInteractor;
use Harmony\Core\Domain\Interactor\PutAllInteractor;
use Harmony\Core\Domain\Interactor\PutInteractor;
use Harmony\Core\Repository\DataSource\DeleteDataSource;
use Harmony\Core\Repository\DataSource\GetDataSource;
use Harmony\Core\Repository\DataSource\PutDataSource;
use Harmony\Core\Repository\RepositoryMapper;
use Harmony\Core\Repository\SingleDataSourceRepository;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;
use Sample\Product\Data\Mapper\ProductToProductEntityMapper;
use Sample\Product\Domain\Model\Product;

class ProductProvider {
  /** @var RepositoryMapper<Product, ProductEntity> */
  protected RepositoryMapper $productRepository;

  /**
   * @param GetDataSource&PutDataSource&DeleteDataSource $dataSource
   */
  // @phpstan-ignore-next-line
  public function __construct(mixed $dataSource) {
    $this->productRepository = $this->provideRepository($dataSource);
  }

  /**
   * @param GetDataSource&PutDataSource&DeleteDataSource $dataSource
   *
   * @return RepositoryMapper<Product, ProductEntity>
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
   * @return GetAllInteractor<Product>
   */
  public function provideGetAllInteractor(): GetAllInteractor {
    return new GetAllInteractor($this->productRepository);
  }

  /**
   * @return PutInteractor<Product>
   */
  public function providePutInteractor(): PutInteractor {
    return new PutInteractor($this->productRepository);
  }

  /**
   * @return PutAllInteractor<Product>
   */
  public function providePutAllInteractor(): PutAllInteractor {
    return new PutAllInteractor($this->productRepository);
  }

  /**
   * @return DeleteInteractor
   */
  public function provideDeleteInteractor(): DeleteInteractor {
    return new DeleteInteractor($this->productRepository);
  }
}
