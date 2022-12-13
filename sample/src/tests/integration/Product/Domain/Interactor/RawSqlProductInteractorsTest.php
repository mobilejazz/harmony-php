<?php

namespace App\Tests\integration\Product\Domain\Interactor;

use App\Tests\Helper\Pdo\DatabaseTest;
use App\Tests\unit\Product\Domain\Interactor\ProductInteractorsTest;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Harmony\Core\Repository\DataSource\DataSourceMapper;
use Harmony\Core\Repository\DataSource\Sql\DataSource\RawSqlDataSource;
use Harmony\Core\Repository\DataSource\Sql\Helper\SqlBuilder;
use Latitude\QueryBuilder\QueryFactory;
use Sample\Product\Data\Sql\Mapper\ProductEntityToProductSqlDataMapper;
use Sample\Product\Data\Sql\Mapper\ProductSqlDataToProductEntityMapper;
use Sample\Product\Data\Sql\ProductSqlSchema;
use Sample\Product\ProductProvider;

/**
 * @see RawSqlDataSource
 */
class RawSqlProductInteractorsTest extends ProductInteractorsTest {
  use DatabaseTest;

  /**
   * @psalm-suppress InvalidArgument
   */
  protected function getProvider(): ProductProvider {
    $sqlBuilder = new SqlBuilder(new ProductSqlSchema(), new QueryFactory());
    $pdoWrapper = new PdoWrapper($this->getPdo());
    $dataSource = new RawSqlDataSource($pdoWrapper, $sqlBuilder);

    $productDataSource = new DataSourceMapper(
      $dataSource,
      $dataSource,
      $dataSource,
      // @phpstan-ignore-next-line
      new ProductEntityToProductSqlDataMapper(),
      // @phpstan-ignore-next-line
      new ProductSqlDataToProductEntityMapper(),
    );

    $productProvider = new ProductProvider($productDataSource);

    return $productProvider;
  }
}
