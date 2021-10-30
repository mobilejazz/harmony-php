<?php

namespace Sample\User;

use DI\ContainerBuilder;
use Harmony\Core\Data\DataSource\DataSourceMapper;
use Harmony\Core\Data\RepositoryMapper;
use Harmony\Core\Data\SingleDataSourceRepository;
use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Harmony\Core\Module\Sql\DataSource\RawSqlDataSource;
use Harmony\Core\Module\Sql\Helper\SqlBuilder;
use Latitude\QueryBuilder\QueryFactory;
use Psr\Container\ContainerInterface;
use Sample\User\Data\DataSource\Sql\Mapper\UserEntityToSqlDataMapper;
use Sample\User\Data\DataSource\Sql\Mapper\UserSqlDataToEntityMapper;
use Sample\User\Data\DataSource\Sql\UserSqlSchema;
use Sample\User\Data\Mapper\UserEntityToModelMapper;
use Sample\User\Data\Mapper\UserModelToEntityMapper;
use Sample\User\Domain\Interactor\GetAllUsersWithNameInteractor;

class UserResolver implements ResolverInterface {
  protected const KEY_USER_REPOSITORY = "Repository<User>";
  protected const KEY_USER_GET_ALL = "GetAllInteractor<User>";

  public function register(ContainerBuilder $containerBuilder): void {
    $containerBuilder->addDefinitions([
      self::KEY_USER_REPOSITORY => function (ContainerInterface $di) {
        $pdo = $di->get(PdoWrapper::class);
        $queryFactory = $di->get(QueryFactory::class);

        $sqlBuilder = new SqlBuilder(new UserSqlSchema(), $queryFactory);
        $dataSource = new RawSqlDataSource($pdo, $sqlBuilder);

        $dataSourceMapper = new DataSourceMapper(
          $dataSource,
          $dataSource,
          $dataSource,
          new UserEntityToSqlDataMapper(),
          new UserSqlDataToEntityMapper(),
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
          new UserModelToEntityMapper(),
          new UserEntityToModelMapper(),
        );

        return $productRepositoryMapper;
      },
      self::KEY_USER_GET_ALL => function (ContainerInterface $di) {
        return new GetAllInteractor($di->get(self::KEY_USER_REPOSITORY));
      },
      GetAllUsersWithNameInteractor::class => function (
        ContainerInterface $di,
      ) {
        return new GetAllUsersWithNameInteractor(
          $di->get(self::KEY_USER_GET_ALL),
        );
      },
    ]);
  }
}
