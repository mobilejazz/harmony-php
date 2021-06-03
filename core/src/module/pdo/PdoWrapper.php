<?php

namespace harmony\core\module\pdo;

use Exception;
use PDO;
use PDOStatement;

/**
 * @link https://phpdelusions.net/pdo
 * @link https://phpdelusions.net/pdo_examples
 */
class PdoWrapper {
  public function __construct(
    protected PDO $pdoConnection
  ) {
  }

  /**
   * @param string  $sql
   * @param mixed[] $params
   *
   * @return mixed
   * @throws Exception
   */
  public function findOne(string $sql, array $params): mixed {
    $query = $this->execute($sql, $params);
    return $query->fetch();
  }

  /**
   * @param string  $sql
   * @param mixed[] $params
   *
   * @return mixed[]
   * @throws Exception
   */
  public function findAll(string $sql, array $params): array {
    $query = $this->execute($sql, $params);
    $items = $query->fetchAll();

    if ($items === false) {
      throw new Exception("Error on Fetch All.");
    }

    return $items;
  }

  /**
   * @param string  $sql
   * @param mixed[] $params
   *
   * @return bool|PDOStatement
   * @throws Exception
   */
  public function executeTransaction(string $sql, array $params): bool|PDOStatement {
    try {
      $this->startTransaction();
      $result = $this->execute($sql, $params);
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
   * @param string  $sql
   * @param mixed[] $params
   *
   * @return PDOStatement
   * @throws Exception
   */
  public function execute(string $sql, array $params): PDOStatement {
    $query = $this->pdoConnection->prepare($sql);

    if (empty($query)) {
      throw new Exception("PDO Connection not ready.");
    }

    $query->execute($params);

    return $query;
  }
}
