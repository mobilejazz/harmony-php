<?php

namespace Sample\Product;

use Harmony\Core\Repository\DataSource\InMemoryDataSource;
use Harmony\Core\Repository\RepositoryMapper;
use Harmony\Core\Repository\SingleDataSourceRepository;
use Harmony\Core\Domain\Interactor\DeleteInteractor;
use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Harmony\Core\Domain\Interactor\GetInteractor;
use Harmony\Core\Domain\Interactor\PutAllInteractor;
use Harmony\Core\Domain\Interactor\PutInteractor;
use Harmony\Core\Module\Config\ResolverInterface;
use Psr\Container\ContainerInterface;
use Sample\Product\Controller\ProductAction;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;
use Sample\Product\Data\Mapper\ProductToProductEntityMapper;
use Sample\Product\Domain\Model\Product;
use function DI\factory;

class ProductResolver implements ResolverInterface {
  protected const KEY_PRODUCT_REPOSITORY = "Repository<Product>";
  protected const KEY_PRODUCT_GET = "GetInteractor<Product>";
  protected const KEY_PRODUCT_GET_ALL = "GetAllInteractor<Product>";
  protected const KEY_PRODUCT_PUT = "PutInteractor<Product>";
  protected const KEY_PRODUCT_PUT_ALL = "PutAllInteractor<Product>";
  protected const KEY_PRODUCT_DELETE = "DeleteInteractor<Product>";

  /**
   * @inheritDoc
   */
  public function __invoke(): array {
    return [
      self::KEY_PRODUCT_REPOSITORY => factory([
        self::class,
        "factoryRepositoryInMemory",
      ]),
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
    ];
  }

  public function factoryRepositoryInMemory(): RepositoryMapper {
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
}
