<?php

namespace Harmony\Core\Module\Pdo;

use DateTime;
use Exception;
use Harmony\Core\Module\Pdo\Error\PdoConnectionNotReadyException;
use Harmony\Core\Module\Pdo\Error\PdoFetchAllException;
use Harmony\Core\Module\Sql\DataSource\SqlInterface;
use PDO;
use PDOStatement;

/**
 * @link https://phpdelusions.net/pdo
 * @link https://phpdelusions.net/pdo_examples
 */
class PdoWrapper implements SqlInterface {
  public function __construct(protected PDO $pdoConnection) {
  }

  /**
   * @param string $sql
   * @param array<string, mixed> $params
   *
   * @return object|null
   * @throws PdoConnectionNotReadyException
   */
  public function findOne(string $sql, array $params): ?object {
    $query = $this->execute($sql, $params);
    $item = $query->fetch();

    if ($item === false) {
      return null;
    }

    return $item;
  }

  /**
   * @param string $sql
   * @param array<string, mixed> $params
   *
   * @return array<object>
   * @throws PdoConnectionNotReadyException
   * @throws PdoFetchAllException
   */
  public function findAll(string $sql, array $params): array {
    $query = $this->execute($sql, $params);
    $items = $query->fetchAll();

    if ($items === false) {
      throw new PdoFetchAllException();
    }

    return $items;
  }

  /**
   * @param string $sql
   * @param array<string, mixed> $params
   *
   * @return int|string
   * @throws PdoConnectionNotReadyException
   */
  public function insert(string $sql, array $params): int|string {
    $this->execute($sql, $params);
    return $this->pdoConnection->lastInsertId();
  }

  /**
   * @throws PdoConnectionNotReadyException|Exception
   */
  public function transaction(callable|array $callback, mixed $params): mixed {
    try {
      $this->startTransaction();
      $result = call_user_func($callback, $params);
      $this->endTransaction();
    } catch (Exception $error) {
      $this->rollbackTransaction();
      throw $error;
    }

    return $result;
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

  /**
   * @param string $sql
   * @param array<string, mixed>  $params
   *
   * @return PDOStatement
   * @throws PdoConnectionNotReadyException
   */
  public function execute(string $sql, array $params): mixed {
    $query = $this->pdoConnection->prepare($sql);

    if (empty($query)) {
      throw new PdoConnectionNotReadyException();
    }

    error_log($this->sql_debug($sql, $params));

    $query->execute($params);

    return $query;
  }
}
