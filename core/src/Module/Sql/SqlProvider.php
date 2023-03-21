<?php

namespace Harmony\Core\Module\Sql;

use Harmony\Core\Data\DataSource\DataSourceMapper;
use Harmony\Core\Data\Mapper\ArrayMapper;
use Harmony\Core\Data\Mapper\BlankMapper;
use Harmony\Core\Data\Mapper\Mapper;
use Harmony\Core\Data\Repository\SingleGetDataSourceRepository;
use Harmony\Core\Domain\Interactor\GetCountInteractor;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Harmony\Core\Module\Sql\DataSource\ArrayRawSqlDataSource;
use Harmony\Core\Module\Sql\DataSource\RawSqlDataSource;
use Harmony\Core\Module\Sql\Schema\SqlSchema;
use Harmony\Core\Module\Sql\Schema\VoidSqlSchema;

class SqlProvider {
  public static function countInteractor(
    PdoWrapper $pdo,
    SqlBuilder $sqlBuilder,
    SqlSchema $schema,
  ): GetCountInteractor {
    $dataSource = self::dataSource($pdo, $sqlBuilder, $schema);

    /** @var SingleGetDataSourceRepository<int> $countRepository */
    $countRepository = new SingleGetDataSourceRepository($dataSource);

    return new GetCountInteractor($countRepository);
  }

  // @phpstan-ignore-next-line
  public static function dataSource(
    PdoWrapper $pdoWrapper,
    SqlBuilder $sqlBuilder,
    SqlSchema $schema = new VoidSqlSchema(),
    Mapper $entityToDataMapper = new BlankMapper(),
    Mapper $dataToEntityMapper = new BlankMapper(),
  ): DataSourceMapper {
    $dataSource = new RawSqlDataSource(
      pdo: $pdoWrapper,
      sqlBuilder: $sqlBuilder,
      schema: $schema,
    );

    return new DataSourceMapper(
      $dataSource,
      $dataSource,
      $dataSource,
      $entityToDataMapper,
      $dataToEntityMapper,
    );
  }

  /**
   * @psalm-suppress InvalidArgument
   */
  // @phpstan-ignore-next-line
  public static function arrayDataSource(
    PdoWrapper $pdoWrapper,
    SqlBuilder $sqlBuilder,
    SqlSchema $schema = new VoidSqlSchema(),
    Mapper $entityToDataMapper = new BlankMapper(),
    Mapper $dataToEntityMapper = new BlankMapper(),
  ): DataSourceMapper {
    $dataSource = new ArrayRawSqlDataSource(
      pdo: $pdoWrapper,
      sqlBuilder: $sqlBuilder,
      schema: $schema,
    );

    return new DataSourceMapper(
      $dataSource,
      $dataSource,
      $dataSource,
      new ArrayMapper($entityToDataMapper),
      new ArrayMapper($dataToEntityMapper),
    );
  }
}
