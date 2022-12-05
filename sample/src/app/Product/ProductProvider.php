<?php

namespace Sample\Product;

use Harmony\Core\Domain\Interactor\DeleteInteractor;
use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Harmony\Core\Domain\Interactor\GetInteractor;
use Harmony\Core\Domain\Interactor\PutAllInteractor;
use Harmony\Core\Domain\Interactor\PutInteractor;
use Harmony\Core\Repository\DataSource\DeleteDataSource;
use Harmony\Core\Repository\DataSource\GetDataSource;
use Harmony\Core\Repository\DataSource\InMemoryDataSource;
use Harmony\Core\Repository\DataSource\PutDataSource;
use Harmony\Core\Repository\RepositoryMapper;
use Harmony\Core\Repository\SingleDataSourceRepository;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;
use Sample\Product\Data\Mapper\ProductToProductEntityMapper;
use Sample\Product\Domain\Model\Product;

class ProductProvider {
  /** @var string */
  protected const KEY_PRODUCT_REPOSITORY = "RepositoryMapper<Product, ProductEntity>";

  /** @var array<string, mixed> */
  protected array $diContainer = [];

  /**
   * @param GetDataSource&PutDataSource&DeleteDataSource $dataSource
   *
   * @return RepositoryMapper<Product, ProductEntity>
   *
   * @psalm-suppress PossiblyInvalidArgument
   * @psalm-suppress DocblockTypeContradiction
   */
  // @phpstan-ignore-next-line
  protected function provideRepository(
    mixed $dataSource = null,
  ): RepositoryMapper {
    if (
      !$dataSource instanceof GetDataSource ||
      !$dataSource instanceof PutDataSource ||
      !$dataSource instanceof DeleteDataSource
    ) {
      $dataSource = new InMemoryDataSource(ProductEntity::class);
    }

    $singleRepository = new SingleDataSourceRepository(
      $dataSource,
      $dataSource,
      $dataSource,
    );

    $repositoryMapper = new RepositoryMapper(
      $singleRepository,
      $singleRepository,
      $singleRepository,
      // @phpstan-ignore-next-line
      new ProductToProductEntityMapper(),
      // @phpstan-ignore-next-line
      new ProductEntityToProductMapper(),
    );

    // @phpstan-ignore-next-line
    return $repositoryMapper;
  }

  /**
   * @return RepositoryMapper<Product, ProductEntity>
   */
  protected function getRepository(): RepositoryMapper {
    if (empty($this->diContainer[self::KEY_PRODUCT_REPOSITORY])) {
      $this->registerRepository();
    }

    /** @var RepositoryMapper<Product, ProductEntity> $repository */
    $repository = $this->diContainer[self::KEY_PRODUCT_REPOSITORY];

    return $repository;
  }

  /**
   * @param GetDataSource&PutDataSource&DeleteDataSource $dataSource
   */
  // @phpstan-ignore-next-line
  public function registerRepository(mixed $dataSource = null): void {
    $this->diContainer[self::KEY_PRODUCT_REPOSITORY] = $this->provideRepository(
      $dataSource,
    );
  }

  /**
   * @return GetInteractor<Product>
   */
  public function provideGetInteractor(): GetInteractor {
    return new GetInteractor($this->getRepository());
  }

  /**
   * @return GetAllInteractor<Product>
   */
  public function provideGetAllInteractor(): GetAllInteractor {
    return new GetAllInteractor($this->getRepository());
  }

  /**
   * @return PutInteractor<Product>
   */
  public function providePutInteractor(): PutInteractor {
    return new PutInteractor($this->getRepository());
  }

  /**
   * @return PutAllInteractor<Product>
   */
  public function providePutAllInteractor(): PutAllInteractor {
    return new PutAllInteractor($this->getRepository());
  }

  /**
   * @return DeleteInteractor
   */
  public function provideDeleteInteractor(): DeleteInteractor {
    return new DeleteInteractor($this->getRepository());
  }
}
