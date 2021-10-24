<?php

namespace Sample\Product;

use Closure;
use DI\ContainerBuilder;
use Harmony\Core\Data\DataSource\DataSourceMapper;
use Harmony\Core\Data\DataSource\InMemoryDataSource;
use Harmony\Core\Data\RepositoryMapper;
use Harmony\Core\Data\SingleDataSourceRepository;
use Harmony\Core\Domain\Interactor\DeleteInteractor;
use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Harmony\Core\Domain\Interactor\GetInteractor;
use Harmony\Core\Domain\Interactor\PutAllInteractor;
use Harmony\Core\Domain\Interactor\PutInteractor;
use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Harmony\Core\Module\Sql\DataSource\RawSqlDataSource;
use Harmony\Core\Module\Sql\Helper\SqlBuilder;
use Latitude\QueryBuilder\QueryFactory;
use Psr\Container\ContainerInterface;
use Sample\Product\Controller\ProductAction;
use Sample\Product\Data\DataSource\Sql\Mapper\ProductEntityToSqlDataMapper;
use Sample\Product\Data\DataSource\Sql\Mapper\ProductSqlDataToEntityMapper;
use Sample\Product\Data\DataSource\Sql\ProductSqlSchema;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;
use Sample\Product\Data\Mapper\ProductToProductEntityMapper;
use Sample\Product\Domain\Model\Product;

class ProductResolver implements ResolverInterface {
  protected const KEY_PRODUCT_REPOSITORY = "Repository<Product>";
  protected const KEY_PRODUCT_GET = "GetInteractor<Product>";
  protected const KEY_PRODUCT_GET_ALL = "GetAllInteractor<Product>";
  protected const KEY_PRODUCT_PUT = "PutInteractor<Product>";
  protected const KEY_PRODUCT_PUT_ALL = "PutAllInteractor<Product>";
  protected const KEY_PRODUCT_DELETE = "DeleteInteractor<Product>";

  /** @var array<string, mixed> */
  protected array $di_container = [];

  public function register(ContainerBuilder $containerBuilder): void {
    $containerBuilder->addDefinitions($this->factoryRepositoryInMemory());
    $containerBuilder->addDefinitions([
      self::KEY_PRODUCT_GET => function (ContainerInterface $di) {
        /** @var RepositoryMapper<Product, ProductEntity> $repository */
        $repository = $di->get(self::KEY_PRODUCT_REPOSITORY);
        return new GetInteractor($repository);
      },
      self::KEY_PRODUCT_GET_ALL => function (ContainerInterface $di) {
        /** @var RepositoryMapper<Product, ProductEntity> $repository */
        $repository = $di->get(self::KEY_PRODUCT_REPOSITORY);
        return new GetAllInteractor($repository);
      },
      self::KEY_PRODUCT_PUT => function (ContainerInterface $di) {
        /** @var RepositoryMapper<Product, ProductEntity> $repository */
        $repository = $di->get(self::KEY_PRODUCT_REPOSITORY);
        return new PutInteractor($repository);
      },
      self::KEY_PRODUCT_PUT_ALL => function (ContainerInterface $di) {
        /** @var RepositoryMapper<Product, ProductEntity> $repository */
        $repository = $di->get(self::KEY_PRODUCT_REPOSITORY);
        return new PutAllInteractor($repository);
      },
      self::KEY_PRODUCT_DELETE => function (ContainerInterface $di) {
        /** @var RepositoryMapper<Product, ProductEntity> $repository */
        $repository = $di->get(self::KEY_PRODUCT_REPOSITORY);
        return new DeleteInteractor($repository);
      },
      ProductAction::class => function (ContainerInterface $di) {
        /** @var GetInteractor<Product> $getInteractor */
        $getInteractor = $di->get(self::KEY_PRODUCT_GET);
        /** @var GetAllInteractor<Product> $getAllInteractor */
        $getAllInteractor = $di->get(self::KEY_PRODUCT_GET_ALL);
        /** @var PutInteractor<Product> $putInteractor */
        $putInteractor = $di->get(self::KEY_PRODUCT_PUT);
        /** @var PutAllInteractor<Product> $putAllInteractor */
        $putAllInteractor = $di->get(self::KEY_PRODUCT_PUT_ALL);
        /** @var DeleteInteractor<Product> $deleteInteractor */
        $deleteInteractor = $di->get(self::KEY_PRODUCT_DELETE);

        return new ProductAction(
          $getInteractor,
          $getAllInteractor,
          $putInteractor,
          $putAllInteractor,
          $deleteInteractor,
        );
      },
    ]);
  }

  /**
   * @return Closure[]
   */
  public function factoryRepositoryInMemory(): array {
    return [
      self::KEY_PRODUCT_REPOSITORY => function () {
        $productInMemoryDataSource = new InMemoryDataSource(
          ProductEntity::class,
        );

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
      },
    ];
  }

  public function factoryRepositorySql(
    PdoWrapper $pdo,
    QueryFactory $queryFactory,
  ): array {
    return [
      self::KEY_PRODUCT_REPOSITORY => function () use ($pdo, $queryFactory) {
        $sqlBuilder = new SqlBuilder(new ProductSqlSchema(), $queryFactory);

        $dataSource = new RawSqlDataSource($pdo, $sqlBuilder);

        $dataSourceMapper = new DataSourceMapper(
          $dataSource,
          $dataSource,
          $dataSource,
          new ProductEntityToSqlDataMapper(),
          new ProductSqlDataToEntityMapper(),
        );

        $productRepository = new SingleDataSourceRepository(
          $dataSourceMapper,
          $dataSourceMapper,
          $dataSourceMapper,
        );

        $productRepositoryMapper = new RepositoryMapper(
          $productRepository,
          $productRepository,
          $productRepository,
          new ProductToProductEntityMapper(),
          new ProductEntityToProductMapper(),
        );

        return $productRepositoryMapper;
      },
    ];
  }
}
