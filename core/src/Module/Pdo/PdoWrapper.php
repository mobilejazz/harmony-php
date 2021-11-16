<?php

namespace Harmony\Core\Module\Pdo;

use Exception;
use Harmony\Core\Module\Pdo\Error\PdoConnectionNotReadyException;
use Harmony\Core\Module\Pdo\Error\PdoFetchAllException;
use Harmony\Core\Module\Sql\DataSource\SqlInterface;
use PDO;

/**
 * @link https://phpdelusions.net/pdo
 * @link https://phpdelusions.net/pdo_examples
 */
class PdoWrapper implements SqlInterface {
  public function __construct(protected PDO $pdoConnection) {
  }

  /**
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

  public function sql_debug($sql_string, array $params = null) {
    if (!empty($params)) {
      $indexed = $params == array_values($params);
      foreach ($params as $k => $v) {
        if (is_object($v)) {
          if ($v instanceof \DateTime) {
            $v = $v->format("Y-m-d H:i:s");
          } else {
            continue;
          }
        } elseif (is_string($v)) {
          $v = "'$v'";
        } elseif ($v === null) {
          $v = "NULL";
        } elseif (is_array($v)) {
          $v = implode(",", $v);
        }

        if ($indexed) {
          $sql_string = preg_replace("/\?/", $v, $sql_string, 1);
        } else {
          if ($k[0] != ":") {
            $k = ":" . $k;
          } //add leading colon if it was left out
          $sql_string = str_replace($k, $v, $sql_string);
        }
      }
    }
    return $sql_string;
  }
}
