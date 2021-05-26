<?php

namespace harmony\core\module\pdo;

use Exception;
use harmony\core\repository\datasource\DeleteDataSource;
use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\datasource\PutDataSource;
use harmony\core\repository\error\DataNotFoundException;
use harmony\core\repository\error\QueryNotSupportedException;
use harmony\core\repository\query\AllQuery;
use harmony\core\repository\query\IdQuery;
use harmony\core\repository\query\KeyQuery;
use harmony\core\repository\query\Query;
use harmony\core\repository\query\VoidQuery;
use InvalidArgumentException;

/**
 * @template   T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 */
class PdoDataSource implements GetDataSource, PutDataSource, DeleteDataSource {
  /**
   * @psalm-param class-string<T> $genericClass
   *
   * @param string                $genericClass
   * @param PdoWrapper            $pdo
   * @param SqlBuilder            $sqlBuilder
   */
  public function __construct(
    protected string $genericClass,
    protected PdoWrapper $pdo,
    protected SqlBuilder $sqlBuilder
  ) {
  }

  public function get(Query $query) {
    $sql = match (true) {
      $query instanceof KeyQuery => $this->sqlBuilder->selectByKey($query->geKey()),
      $query instanceof IdQuery => $this->sqlBuilder->selectById($query->getId()),
      default => throw new QueryNotSupportedException()
    };

    $item = $this->pdo->findOne($sql->sql(), $sql->params());

    if (!isset($item)) {
      throw new DataNotFoundException();
    }

    return $item;
  }

  public function getAll(Query $query): array {
    $sql = match (true) {
      $query instanceof AllQuery => $this->sqlBuilder->selectAll(),
      default => throw new QueryNotSupportedException()
    };

    $items = $this->pdo->findAll($sql->sql(), $sql->params());

    if (!isset($items)) {
      throw new DataNotFoundException();
    }

    return $items;
  }

  public function put(Query $query, PdoEntityInterface $entity = null) {
    if ($entity === null) {
      throw new InvalidArgumentException();
    }

    $sql = match (true) {
      $query instanceof VoidQuery => $this->sqlBuilder->insert($entity),
      $query instanceof IdQuery => $this->sqlBuilder->updateById($query->getId(), $entity),
      default => throw new QueryNotSupportedException()
    };

    $this->pdo->execute($sql->sql(), $sql->params());
  }

  public function putAll(Query $query, array $entities = null): array {
    if ($entities === null) {
      throw new InvalidArgumentException();
    }

    $sql = match (true) {
      $query instanceof VoidQuery => $this->sqlBuilder->multiInsert($entities),
      default => throw new QueryNotSupportedException()
    };

    $this->pdo->executeTransaction($sql->sql(), $sql->params());
    return $entities;
  }

  public function delete(Query $query): void {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->deleteById($query->getId()),
      default => throw new QueryNotSupportedException()
    };

    $this->pdo->executeTransaction($sql->sql(), $sql->params());
  }
}
