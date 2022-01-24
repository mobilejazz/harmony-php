<?php

namespace Sample\Product;

use Harmony\Core\Repository\DataSource\InMemoryDataSource;
use Harmony\Core\Repository\RepositoryMapper;
use Harmony\Core\Repository\SingleDataSourceRepository;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;
use Sample\Product\Data\Mapper\ProductToProductEntityMapper;
use Sample\Product\Domain\Interactor\DeleteProductInteractor;
use Sample\Product\Domain\Interactor\GetAllProductInteractor;
use Sample\Product\Domain\Interactor\GetProductInteractor;
use Sample\Product\Domain\Interactor\PutAllProductInteractor;
use Sample\Product\Domain\Interactor\PutProductInteractor;
use Sample\Product\Domain\Model\Product;

class ProductModule {
  /** @var string */
  protected const KEY_PRODUCT_REPOSITORY = "ProductRepository";

  /** @var array<string, mixed> */
  protected array $di_container = [];

  /**
   * @return RepositoryMapper<Product, ProductEntity>
   */
  protected function registerRepository(): RepositoryMapper {
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
  public function getProductRepository(): RepositoryMapper {
    if (empty($this->di_container[self::KEY_PRODUCT_REPOSITORY])) {
      $this->di_container[
        self::KEY_PRODUCT_REPOSITORY
      ] = $this->registerRepository();
    }

    return $this->di_container[self::KEY_PRODUCT_REPOSITORY];
  }

  /**
   * @return GetProductInteractor
   */
  public function getGetInteractor(): GetProductInteractor {
    return new GetProductInteractor($this->getProductRepository());
  }

  /**
   * @return GetAllProductInteractor
   */
  public function getGetAllInteractor(): GetAllProductInteractor {
    return new GetAllProductInteractor($this->getProductRepository());
  }

  /**
   * @return PutProductInteractor
   */
  public function getPutInteractor(): PutProductInteractor {
    return new PutProductInteractor($this->getProductRepository());
  }

  /**
   * @return PutAllProductInteractor
   */
  public function getPutAllInteractor(): PutAllProductInteractor {
    return new PutAllProductInteractor($this->getProductRepository());
  }

  /**
   * @return DeleteProductInteractor
   */
  public function getDeleteInteractor(): DeleteProductInteractor {
    return new DeleteProductInteractor($this->getProductRepository());
  }
}
