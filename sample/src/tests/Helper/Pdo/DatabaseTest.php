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
   * @see            PdoFactory
   * @psalm-suppress PossiblyFalseArgument
   */
  protected static function createNewConnection(): void {
    $host = !empty(getenv("PHPUNIT_DB_HOST"))
      ? getenv("PHPUNIT_DB_HOST")
      : "127.0.0.1";
    $name = !empty(getenv("PHPUNIT_DB_NAME"))
      ? getenv("PHPUNIT_DB_NAME")
      : "sampledb";
    $user = !empty(getenv("PHPUNIT_DB_USER"))
      ? getenv("PHPUNIT_DB_USER")
      : "root";
    $password = !empty(getenv("PHPUNIT_DB_PASSWORD"))
      ? getenv("PHPUNIT_DB_PASSWORD")
      : "M6Yp5Tho4mT3mT7upGSY";

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
