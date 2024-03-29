<?php

namespace Harmony\Core\Module\Pdo;

use Exception;
use Harmony\Core\Module\Pdo\Error\PdoConnectionNotReadyException;
use Harmony\Core\Module\Sql\DataSource\SqlService;
use PDO;
use PDOStatement;

/**
 * @link https://phpdelusions.net/pdo
 * @link https://phpdelusions.net/pdo_examples
 */
class PdoWrapper implements SqlService {
  public function __construct(protected readonly PDO $pdoConnection) {
  }

  /**
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return object|null
   * @throws PdoConnectionNotReadyException
   */
  public function findOne(string $sql, array $params): ?object {
    $query = $this->execute($sql, $params);
    $item = $query->fetch();

    if ($item === false || !is_object($item)) {
      return null;
    }

    return $item;
  }

  /**
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return array<object>
   * @throws PdoConnectionNotReadyException
   */
  public function findAll(string $sql, array $params): array {
    $query = $this->execute($sql, $params);

    return $query->fetchAll();
  }

  /**
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @throws PdoConnectionNotReadyException
   */
  public function insert(string $sql, array $params): int {
    $this->execute($sql, $params);

    return (int) $this->pdoConnection->lastInsertId();
  }

  /**
   * @param string               $sql
   * @param array<string, mixed> $params
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

  /**
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return PDOStatement<mixed>
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
}
