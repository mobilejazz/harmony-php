<?php

namespace App\Tests\Helper\Pdo;

use Harmony\Core\Module\Pdo\PdoWrapper;
use Harmony\Core\Repository\DataSource\Sql\Helper\SqlBuilder;
use Harmony\Core\Repository\DataSource\Sql\Helper\SqlSchema;
use InvalidArgumentException;
use Latitude\QueryBuilder\Engine\MySqlEngine;
use Latitude\QueryBuilder\QueryFactory;
use PDO;

trait DatabaseTest {
  private static ?PDO $dbh;

  public function setUp(): void {
    $this->getPdo()->beginTransaction();
  }

  public function tearDown(): void {
    $this->getPdo()->rollBack();
  }

  public static function setUpBeforeClass(): void {
    self::$dbh = null;
    self::createNewConnection();
    self::emptyDb();

    self::$dbh = null;
    self::createNewConnection();
    self::fillDbStructure();
  }

  public static function tearDownAfterClass(): void {
    self::emptyDb();
    self::$dbh = null;
  }

  protected static function emptyDb(): void {
    $query =
      file_get_contents(__DIR__ . "/db_delete.sql") ?:
      throw new InvalidArgumentException();
    self::$dbh?->prepare($query)->execute();
  }

  protected static function fillDbStructure(): void {
    $query =
      file_get_contents(__DIR__ . "/db_structure.sql") ?:
      throw new InvalidArgumentException();
    self::$dbh?->prepare($query)->execute();
  }

  /**
   * @see PdoFactory
   */
  protected static function createNewConnection(): void {
    $host = getenv("PHPUNIT_DB_HOST");
    $name = getenv("PHPUNIT_DB_NAME");
    $user = getenv("PHPUNIT_DB_USER");
    $password = getenv("PHPUNIT_DB_PASSWORD");
    $dsn = "mysql:host={$host};dbname={$name};port=3306;";

    self::$dbh = new PDO($dsn, $user, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]);
  }

  protected function getPdo(): PDO {
    return self::$dbh ?? throw new InvalidArgumentException();
  }

  protected function getSqlBuilder(SqlSchema $sqlSchema): SqlBuilder {
    $queryFactory = new QueryFactory(new MySqlEngine());
    $sqlBuilder = new SqlBuilder($sqlSchema, $queryFactory);

    return $sqlBuilder;
  }

  protected function insert(SqlSchema $sqlSchema, object $entity): string|int {
    $sqlBuilder = $this->getSqlBuilder($sqlSchema);
    $sql = $sqlBuilder->insert($entity);
    $pdo = new PdoWrapper($this->getPdo());

    $id = $pdo->insert($sql->sql(), $sql->params());

    return $id;
  }
}
