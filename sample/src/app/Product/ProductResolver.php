<?php

namespace Sample\Product;

use Closure;
use DI\ContainerBuilder;
use Harmony\Core\Domain\Interactor\DeleteInteractor;
use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Harmony\Core\Domain\Interactor\GetInteractor;
use Harmony\Core\Domain\Interactor\PutAllInteractor;
use Harmony\Core\Domain\Interactor\PutInteractor;
use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Repository\DataSource\InMemoryDataSource;
use Harmony\Core\Repository\RepositoryMapper;
use Harmony\Core\Repository\SingleDataSourceRepository;
use Psr\Container\ContainerInterface;
use Sample\Product\Controller\ProductAction;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;
use Sample\Product\Data\Mapper\ProductToProductEntityMapper;

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
    $containerBuilder->addDefinitions($this->factoryRepository());
    $containerBuilder->addDefinitions([
      self::KEY_PRODUCT_GET => function (ContainerInterface $di) {
        return new GetInteractor($di->get(self::KEY_PRODUCT_REPOSITORY));
      },
      self::KEY_PRODUCT_GET_ALL => function (ContainerInterface $di) {
        return new GetAllInteractor($di->get(self::KEY_PRODUCT_REPOSITORY));
      },
      self::KEY_PRODUCT_PUT => function (ContainerInterface $di) {
        return new PutInteractor($di->get(self::KEY_PRODUCT_REPOSITORY));
      },
      self::KEY_PRODUCT_PUT_ALL => function (ContainerInterface $di) {
        return new PutAllInteractor($di->get(self::KEY_PRODUCT_REPOSITORY));
      },
      self::KEY_PRODUCT_DELETE => function (ContainerInterface $di) {
        return new DeleteInteractor($di->get(self::KEY_PRODUCT_REPOSITORY));
      },
      ProductAction::class => function (ContainerInterface $di) {
        return new ProductAction(
          $di->get(self::KEY_PRODUCT_GET),
          $di->get(self::KEY_PRODUCT_GET_ALL),
          $di->get(self::KEY_PRODUCT_PUT),
          $di->get(self::KEY_PRODUCT_PUT_ALL),
          $di->get(self::KEY_PRODUCT_DELETE),
        );
      },
    ]);
  }

  /**
   * @return Closure[]
   */
  public function factoryRepository(): array {
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
}
