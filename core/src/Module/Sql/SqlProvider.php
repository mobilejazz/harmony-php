<?php

namespace Harmony\Core\Module\Sql;

use Harmony\Core\Data\Repository\SingleGetDataSourceRepository;
use Harmony\Core\Domain\Interactor\GetCountInteractor;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Harmony\Core\Module\Sql\DataSource\RawSqlDataSource;
use Harmony\Core\Module\Sql\Schema\SqlSchemaInterface;
use Latitude\QueryBuilder\QueryFactory;

class SqlProvider {
  public static function getCountInteractor(
    PdoWrapper $pdo,
    QueryFactory $queryFactory,
    SqlSchemaInterface $schema,
  ): GetCountInteractor {
    $sqlBuilder = new SqlBuilder($queryFactory);

    $dataSource = new RawSqlDataSource($pdo, $sqlBuilder, $schema);

    /** @var SingleGetDataSourceRepository<int> $countRepository */
    $countRepository = new SingleGetDataSourceRepository($dataSource);

    return new GetCountInteractor($countRepository);
  }
}
