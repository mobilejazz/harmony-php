<?php

namespace App\Tests\integration\Product\Domain\Interactor;

use App\Tests\Helper\Pdo\DatabaseTest;
use App\Tests\unit\Product\Domain\Interactor\ProductInteractors;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Harmony\Core\Repository\DataSource\DataSourceMapper;
use Harmony\Core\Repository\DataSource\Sql\DataSource\RawSqlDataSource;
use Harmony\Core\Repository\DataSource\Sql\Helper\SqlBuilder;
use Latitude\QueryBuilder\QueryFactory;
use Sample\Product\Data\Sql\Mapper\ProductEntityToSqlDataMapper;
use Sample\Product\Data\Sql\Mapper\ProductSqlDataToEntityMapper;
use Sample\Product\Data\Sql\ProductSqlSchema;
use Sample\Product\ProductProvider;

/**
 * @todo Currently we are doing an update instead of an insert in this test,
 * so,the data is not stored in the DB and the tests fails
 */
class RawSqlProductInteractorsTest extends ProductInteractors {
  use DatabaseTest;

  protected function getProvider(): ProductProvider {
    $sqlBuilder = new SqlBuilder(new ProductSqlSchema(), new QueryFactory());
    $pdoWrapper = new PdoWrapper($this->getPdo());
    $dataSource = new RawSqlDataSource($pdoWrapper, $sqlBuilder);

    $dataSourceMapper = new DataSourceMapper(
      $dataSource,
      $dataSource,
      $dataSource,
      new ProductEntityToSqlDataMapper(),
      new ProductSqlDataToEntityMapper(),
    );

    $productProvider = new ProductProvider();
    $productProvider->registerRepository($dataSourceMapper);

    return $productProvider;
  }
}