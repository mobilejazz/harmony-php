<?php

namespace Harmony\Core\Repository\DataSource\Sql;

use Harmony\Core\Domain\Interactor\GetCountInteractor;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Harmony\Core\Repository\DataSource\Sql\DataSource\RawSqlDataSource;
use Harmony\Core\Repository\DataSource\Sql\Helper\SqlBuilder;
use Harmony\Core\Repository\DataSource\Sql\Helper\SqlSchema;
use Harmony\Core\Repository\SingleGetDataSourceRepository;
use Latitude\QueryBuilder\QueryFactory;

class SqlRepositoryFactory {
  public static function getCountInteractor(
    PdoWrapper $pdo,
    QueryFactory $queryFactory,
    SqlSchema $schema,
  ): GetCountInteractor {
    $sqlBuilder = new SqlBuilder($schema, $queryFactory);

    $dataSource = new RawSqlDataSource($pdo, $sqlBuilder);

    /** @var SingleGetDataSourceRepository<int> $countRepository */
    $countRepository = new SingleGetDataSourceRepository($dataSource);

    return new GetCountInteractor($countRepository);
  }
}
