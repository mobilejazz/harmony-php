<?php

namespace harmony\core\module\pdo;

use PDO;
use PDOStatement;

class PdoWrapper {
  public function __construct(
    protected PDO $pdoConnection
  ) {
  }

  public function findOne(string $sql, array $params) {
    $query = $this->execute($sql, $params);
    return $query->fetch();
  }

  public function findAll(string $sql, array $params): array {
    $query = $this->execute($sql, $params);
    return $query->fetchAll();
  }

  protected function execute(string $sql, array $params): bool|PDOStatement {
    $query = $this->pdoConnection->prepare($sql);
    $query->execute($params);

    return $query;
  }
}
