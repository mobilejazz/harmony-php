<?php

namespace Harmony\Core\Module\Pdo;

use Exception;
use Harmony\Core\Module\Pdo\Exception\PdoConnectionNotReadyException;
use Harmony\Core\Module\Pdo\Exception\PdoFetchAllException;
use Harmony\Core\Module\Sql\DataSource\SqlInterface;
use PDO;

/**
 * @link     https://phpdelusions.net/pdo
 * @link     https://phpdelusions.net/pdo_examples
 */
class PdoWrapper implements SqlInterface {
  public function __construct(protected PDO $pdoConnection) {
  }

  /**
   * @throws PdoConnectionNotReadyException
   */
  public function findOne(
    string $sql,
    array $params,
    string $returnClass = null,
  ): ?object {
    $query = $this->execute($sql, $params, $returnClass);
    return $query->fetch();
  }

  /**
   * @throws PdoConnectionNotReadyException
   * @throws PdoFetchAllException
   */
  public function findAll(
    string $sql,
    array $params,
    string $returnClass = null,
  ): array {
    $query = $this->execute($sql, $params);

    if ($returnClass) {
      $items = $query->fetchAll(
        PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
        $returnClass,
      );
    } else {
      $items = $query->fetchAll();
    }

    if ($items === false) {
      throw new PdoFetchAllException();
    }

    /** @var array<array-key, object> $items */
    return $items;
  }

  /**
   * @throws PdoConnectionNotReadyException
   */
  public function insert(string $sql, array $params): int|string {
    $this->execute($sql, $params);
    return $this->pdoConnection->lastInsertId();
  }

  /**
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
   * @throws PdoConnectionNotReadyException
   */
  public function execute(
    string $sql,
    array $params,
    string $returnClass = null,
  ): mixed {
    $query = $this->pdoConnection->prepare($sql);

    if ($returnClass) {
      $query->setFetchMode(
        PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
        $returnClass,
      );
    }

    if (empty($query)) {
      throw new PdoConnectionNotReadyException();
    }

    $query->execute($params);

    return $query;
  }
}
