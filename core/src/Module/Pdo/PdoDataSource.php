<?php

namespace harmony\core\Module\Pdo;

use harmony\core\Module\Sql\Helper\SqlBuilder;
use harmony\core\Repository\DataSource\DeleteDataSource;
use harmony\core\Repository\DataSource\GetDataSource;
use harmony\core\Repository\DataSource\PutDataSource;
use harmony\core\Repository\Error\DataNotFoundException;
use harmony\core\Repository\Error\QueryNotSupportedException;
use harmony\core\Repository\Query\AllQuery;
use harmony\core\Module\Sql\Query\ComposedSqlQuery;
use harmony\core\Repository\Query\IdQuery;
use harmony\core\Repository\Query\KeyQuery;
use harmony\core\Repository\Query\Query;
use harmony\core\Repository\Query\VoidQuery;
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

  /**
   * @param Query $query
   *
   * @return mixed
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function get(Query $query): mixed {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->selectById($query->getId()),
      $query instanceof KeyQuery => $this->sqlBuilder->selectByKey($query->geKey()),
      default => throw new QueryNotSupportedException()
    };

    $item = $this->pdo->findOne($sql->sql(), $sql->params());

    if (!isset($item)) {
      throw new DataNotFoundException();
    }

    return $item;
  }

  /**
   * @param Query $query
   *
   * @return mixed[]
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function getAll(Query $query): array {
    $sql = match (true) {
      $query instanceof AllQuery => $this->sqlBuilder->selectAll(),
      $query instanceof ComposedSqlQuery => $this->sqlBuilder->selectAllComposed($query),
      default => throw new QueryNotSupportedException()
    };

    $items = $this->pdo->findAll($sql->sql(), $sql->params());

    if (empty($items)) {
      throw new DataNotFoundException();
    }

    return $items;
  }

  /**
   * @param Query      $query
   * @param mixed|null $entity
   *
   * @return mixed
   * @throws QueryNotSupportedException
   */
  public function put(Query $query, mixed $entity = null): mixed {
    if ($entity === null) {
      throw new InvalidArgumentException();
    }

    $sql = match (true) {
      $query instanceof VoidQuery => $this->sqlBuilder->insert($entity),
      $query instanceof IdQuery => $this->sqlBuilder->updateById($query->getId(), $entity),
      default => throw new QueryNotSupportedException()
    };

    $this->pdo->execute($sql->sql(), $sql->params());

    return $entity;
  }

  /**
   * @param Query      $query
   * @param mixed[]|null $entities
   *
   * @return mixed[]
   * @throws QueryNotSupportedException
   */
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

  /**
   * @param Query $query
   *
   * @throws QueryNotSupportedException
   */
  public function delete(Query $query): void {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->deleteById($query->getId()),
      default => throw new QueryNotSupportedException()
    };

    $this->pdo->executeTransaction($sql->sql(), $sql->params());
  }
}
