<?php

namespace harmony\core\module\pdo;

use PDO;

class PdoFactory {
  public function __invoke(
    string $user,
    string $pass,
    ?string $dsn,
    ?string $dbType,
    ?string $host,
    ?string $dbName,
    ?string $charset,
    ?string $port
  ): PDO {
    if (empty($dsn)) {
      $dsn = $this->constructDsn($dbType, $host, $dbName, $charset, $port);
    }

    $pdoConnection = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]);

    return $pdoConnection;
  }

  protected function constructDsn(
    string $dbType,
    string $host,
    string $dbName,
    string $charset = "utf8mb4",
    string $port = "3306"
  ): string {
    return "$dbType:host=$host;dbname=$dbName;charset=$charset;port=$port";
  }
}
