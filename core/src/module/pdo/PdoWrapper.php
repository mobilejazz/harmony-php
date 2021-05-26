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

  public function findOne(string $sql, array $params){
    $query = $this->execute($sql, $params);
    return $query->fetch();
  }

  public function findAll(string $sql, array $params): array {
    $query = $this->execute($sql, $params);
    return $query->fetchAll();
  }

  public function executeTransaction(string $sql, array $params): bool|PDOStatement {
    try {
      $this->startTransaction();
      $result = $this->execute($sql, $params);
      $this->endTransaction();
    }catch (Exception $error){
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

  public function execute(string $sql, array $params): bool|PDOStatement {
    $query = $this->pdoConnection->prepare($sql);
    $query->execute($params);

    return $query;
  }
}
