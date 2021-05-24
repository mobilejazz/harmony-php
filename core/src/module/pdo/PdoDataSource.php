<?php

namespace harmony\core\module\pdo;

use harmony\core\repository\datasource\DeleteDataSource;
use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\datasource\PutDataSource;
use harmony\core\repository\error\DataNotFoundException;
use harmony\core\repository\error\QueryNotSupportedException;
use harmony\core\repository\query\AllQuery;
use harmony\core\repository\query\IdQuery;
use harmony\core\repository\query\KeyQuery;
use harmony\core\repository\query\Query;
use InvalidArgumentException;

/**
 * @template   T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 */
class PdoDataSource implements GetDataSource, PutDataSource, DeleteDataSource {
  protected const TABLE_NAME = 'tableName';
  protected const WHERE_COLUMN = 'whereColumn';
  protected const WHERE_VALUE = 'whereValue';

  /**
   * @psalm-param class-string<T> $genericClass
   *
   * @param string                $genericClass
   * @param PdoWrapper            $pdo
   * @param PdoConfigDataSource   $config
   */
  public function __construct(
    protected string $genericClass,
    protected PdoWrapper $pdo,
    protected PdoConfigDataSource $config
  ) {
  }

  public function get(Query $query) {
    $params = match (true) {
      $query instanceof KeyQuery => [
        self::WHERE_COLUMN => $this->config->getKeyColumn(),
        self::WHERE_VALUE => $query->geKey(),
      ],
      $query instanceof IdQuery => [
        self::WHERE_COLUMN => $this->config->getIdColumn(),
        self::WHERE_VALUE => $query->getId(),
      ],
      default => throw new QueryNotSupportedException()
    };

    $sql = "
        SELECT *
        FROM :{self::TABLE_NAME}
        WHERE :{self::WHERE_COLUMN} = :{self::WHERE_VALUE}
        LIMIT 1
        ";

    $params[self::TABLE_NAME] = $this->config->getTableName();

    $item = $this->pdo->findOne($sql, $params);

    if (!isset($item)) {
      throw new DataNotFoundException();
    }

    return $item;
  }

  public function getAll(Query $query): array {
    $params = match (true) {
      $query instanceof AllQuery => [
      ],
      default => throw new QueryNotSupportedException()
    };

    $sql = "
        SELECT *
        FROM :{self::TABLE_NAME}
        ";

    $params[self::TABLE_NAME] = $this->config->getTableName();

    $items = $this->pdo->findAll($sql, $params);

    if (!isset($items)) {
      throw new DataNotFoundException();
    }

    return $items;
  }

  public function put(Query $query, $entity = null) {
    if ($entity === null) {
      throw new InvalidArgumentException();
    }

    if ($query instanceof KeyQuery) {
      $this->entities[$query->geKey()] = $entity;

      return $entity;
    }

    throw new QueryNotSupportedException();
  }

  public function putAll(Query $query, array $entities = null): array {
    if ($entities === null) {
      throw new InvalidArgumentException();
    }

    if ($query instanceof AllQuery) {
      foreach ($entities as $entity) {
        $this->entities[] = $entity;
      }

      return $entities;
    }

    throw new QueryNotSupportedException();
  }

  public function delete(Query $query): void {
    if ($query instanceof KeyQuery) {
      if (!isset($this->entities[$query->geKey()])) {
        throw new DataNotFoundException();
      }

      unset($this->entities[$query->geKey()]);
      return;
    }

    throw new QueryNotSupportedException();
  }
}
