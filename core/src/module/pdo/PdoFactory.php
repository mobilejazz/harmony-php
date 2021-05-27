<?php

namespace harmony\core\module\pdo;

use PDO;

class PdoFactory {
  public function __invoke(
    string $user,
    string $pass,
    string $host,
    string $dbName,
    string $dbType = "mysql",
    string $charset = "utf8mb4",
    string $port = "3306"
  ): PdoWrapper {
    $dsn = $this->constructDsn($host, $dbName, $dbType, $charset, $port);

    $pdoConnection = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]);

    return new PdoWrapper($pdoConnection);
  }

  protected function constructDsn(
    string $host,
    string $dbName,
    string $dbType,
    string $charset,
    string $port
  ): string {
    return "$dbType:host=$host;dbname=$dbName;charset=$charset;port=$port";
  }
}
