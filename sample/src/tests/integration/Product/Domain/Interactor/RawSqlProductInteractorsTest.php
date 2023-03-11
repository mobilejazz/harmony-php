<?php

namespace App\Tests\integration\Product\Domain\Interactor;

use App\Tests\Helper\Pdo\DatabaseTest;
use App\Tests\unit\Product\Domain\Interactor\ProductInteractorsTest;
use Harmony\Core\Data\DataSource\DataSourceMapper;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Harmony\Core\Module\Sql\DataSource\ArrayRawSqlDataSource;
use Harmony\Core\Module\Sql\DataSource\RawSqlDataSource;
use Harmony\Core\Module\Sql\SqlBuilder;
use Latitude\QueryBuilder\QueryFactory;
use Sample\Product\Data\Sql\Mapper\ProductEntityToProductSqlDataMapper;
use Sample\Product\Data\Sql\Mapper\ProductSqlDataToProductEntityMapper;
use Sample\Product\Data\Sql\ProductSqlSchemaInterface;
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
    $sqlBuilder = new SqlBuilder(new QueryFactory());
    $pdoWrapper = new PdoWrapper($this->getPdo());
    $dataSource = new RawSqlDataSource(
      pdo: $pdoWrapper,
      sqlBuilder: $sqlBuilder,
      schema: new ProductSqlSchemaInterface(),
    );

    $productDataSource = new DataSourceMapper(
      $dataSource,
      $dataSource,
      $dataSource,
      // @phpstan-ignore-next-line
      new ProductEntityToProductSqlDataMapper(),
      // @phpstan-ignore-next-line
      new ProductSqlDataToProductEntityMapper(),
    );

    $arrayDataSource = new ArrayRawSqlDataSource(
      pdo: $pdoWrapper,
      sqlBuilder: $sqlBuilder,
      schema: new ProductSqlSchemaInterface(),
    );

    $arrayProductDataSource = new DataSourceMapper(
      $arrayDataSource,
      $arrayDataSource,
      $arrayDataSource,
      // @phpstan-ignore-next-line
      new ProductEntityToProductSqlDataMapper(),
      // @phpstan-ignore-next-line
      new ProductSqlDataToProductEntityMapper(),
    );

    $productProvider = new ProductProvider(
      $productDataSource,
      $arrayProductDataSource,
    );

    return $productProvider;
  }
}
