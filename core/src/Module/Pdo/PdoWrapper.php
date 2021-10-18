<?php

namespace Harmony\Core\Module\Pdo;

use Exception;
use Harmony\Core\Module\Pdo\Error\PdoConnectionNotReadyException;
use Harmony\Core\Module\Pdo\Error\PdoFetchAllException;
use Harmony\Core\Module\Sql\DataSource\SqlInterface;
use PDO;
use PDOStatement;
use stdClass;

/**
 * @link     https://phpdelusions.net/pdo
 * @link     https://phpdelusions.net/pdo_examples
 */
class PdoWrapper implements SqlInterface {
  public function __construct(protected PDO $pdoConnection) {
  }

  /**
   * @param string $sql
   * @param mixed[]  $params
   *
   * @return PDOStatement
   * @throws PdoConnectionNotReadyException
   */
  public function execute(string $sql, array $params): PDOStatement {
    $query = $this->pdoConnection->prepare($sql);

    if (empty($query)) {
      throw new PdoConnectionNotReadyException();
    }

    $query->execute($params);

    return $query;
  }

  /**
   * @param string $sql
   * @param mixed[]  $params
   *
   * @return mixed
   * @throws PdoConnectionNotReadyException
   */
  public function findOne(string $sql, array $params): mixed {
    $query = $this->execute($sql, $params);
    return $query->fetch();
  }

  /**
   * @param string $sql
   * @param mixed[]  $params
   *
   * @return object[]
   * @throws PdoConnectionNotReadyException
   * @throws PdoFetchAllException
   */
  public function findAll(string $sql, array $params): array {
    $query = $this->execute($sql, $params);
    $items = $query->fetchAll();

    if ($items === false) {
      throw new PdoFetchAllException();
    }

    /** @var array<array-key, object> $items */
    return $items;
  }

  /**
   * @param string $sql
   * @param mixed[]  $params
   *
   * @return bool
   * @throws PdoConnectionNotReadyException
   */
  public function transaction(string $sql, array $params): bool {
    try {
      $this->startTransaction();
      $result = $this->execute($sql, $params);
      $this->endTransaction();
    } catch (Exception $error) {
      $this->rollbackTransaction();
      throw $error;
    }

    return (bool) $result;
  }

  public function startTransaction(): void {
    $this->pdoConnection->beginTransaction();
  }

  public function endTransaction(): void {
    $this->pdoConnection->commit();
  }

  public function rollbackTransaction(): void {
    $this->pdoConnection->rollBack();
  }
}
