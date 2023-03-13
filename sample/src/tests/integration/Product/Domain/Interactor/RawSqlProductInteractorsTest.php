<?php

namespace App\Tests\integration\Product\Domain\Interactor;

use App\Tests\Helper\Pdo\DatabaseTest;
use App\Tests\unit\Product\Domain\Interactor\ProductInteractorsTest;
use Harmony\Core\Module\Sql\DataSource\RawSqlDataSource;
use Harmony\Core\Module\Sql\SqlProvider;
use Sample\Product\Data\Sql\Mapper\ProductEntityToProductSqlDataMapper;
use Sample\Product\Data\Sql\Mapper\ProductSqlDataToProductEntityMapper;
use Sample\Product\Data\Sql\ProductSqlSchemaInterface;
use Sample\Product\ProductProvider;

/**
 * @see RawSqlDataSource
 */
class RawSqlProductInteractorsTest extends ProductInteractorsTest {
  use DatabaseTest;

  protected function getProvider(): ProductProvider {
    $productDataSource = SqlProvider::dataSource(
      pdoWrapper: $this->getPdoWrapper(),
      sqlBuilder: $this->getSqlBuilder(),
      schema: new ProductSqlSchemaInterface(),
      entityToDataMapper: new ProductEntityToProductSqlDataMapper(),
      dataToEntityMapper: new ProductSqlDataToProductEntityMapper(),
    );

    $arrayProductDataSource = SqlProvider::arrayDataSource(
      pdoWrapper: $this->getPdoWrapper(),
      sqlBuilder: $this->getSqlBuilder(),
      schema: new ProductSqlSchemaInterface(),
      entityToDataMapper: new ProductEntityToProductSqlDataMapper(),
      dataToEntityMapper: new ProductSqlDataToProductEntityMapper(),
    );

    return new ProductProvider($productDataSource, $arrayProductDataSource);
  }
}
