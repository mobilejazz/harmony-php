<?php

namespace Harmony\Core\Module\Sql\DataSource;

use Harmony\Core\Module\Sql\Helper\SqlBuilder;
use Harmony\Core\Module\Sql\Query\ComposedSqlQuery;
use Harmony\Core\Repository\DataSource\DeleteDataSource;
use Harmony\Core\Repository\DataSource\GetDataSource;
use Harmony\Core\Repository\DataSource\PutDataSource;
use Harmony\Core\Repository\Error\DataNotFoundException;
use Harmony\Core\Repository\Error\QueryNotSupportedException;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\Composed\ComposedQuery;
use Harmony\Core\Repository\Query\IdQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Repository\Query\VoidQuery;
use InvalidArgumentException;

/**
 * @implements GetDataSource<object>
 * @implements PutDataSource<object>
 * @implements DeleteDataSource<object>
 */
class RawSqlDataSource implements
  GetDataSource,
  PutDataSource,
  DeleteDataSource {
  /**
   * @param SqlInterface $pdo
   * @param SqlBuilder   $sqlBuilder
   */
  public function __construct(
    protected SqlInterface $pdo,
    protected SqlBuilder $sqlBuilder,
  ) {
  }

  /**
   * @psalm-suppress ImplementedReturnTypeMismatch
   *
   * @param Query $query
   *
   * @return object
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function get(Query $query): object {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->selectById(
        $query->getId(),
      ),
      $query instanceof KeyQuery => $this->sqlBuilder->selectByKey(
        $query->geKey(),
      ),
      default => throw new QueryNotSupportedException()
    };

    $item = $this->pdo->findOne($sql->sql(), $sql->params());

    if (!isset($item)) {
      throw new DataNotFoundException();
    }

    return $item;
  }

  /**
   * @psalm-suppress ImplementedReturnTypeMismatch
   *
   * @param Query $query
   *
   * @return object[]
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function getAll(Query $query): array {
    $sql = match (true) {
      $query instanceof AllQuery => $this->sqlBuilder->selectAll(),
      $query instanceof ComposedQuery => $this->sqlBuilder->selectAllComposed($query),
      default => throw new QueryNotSupportedException()
    };

    $items = $this->pdo->findAll($sql->sql(), $sql->params());

    if (empty($items)) {
      throw new DataNotFoundException();
    }

    return $items;
  }

  /**
   * @psalm-suppress LessSpecificImplementedReturnType
   *
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
      $query instanceof IdQuery => $this->sqlBuilder->updateById(
        $query->getId(),
        $entity,
      ),
      default => throw new QueryNotSupportedException()
    };

    $this->pdo->execute($sql->sql(), $sql->params());

    return $entity;
  }

  /**
   * @psalm-suppress MoreSpecificImplementedParamType
   *
   * @param Query         $query
   * @param object[]|null $entities
   *
   * @return object[]
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

    $this->pdo->transaction($sql->sql(), $sql->params());

    return $entities;
  }

  /**
   * @param Query $query
   *
   * @throws QueryNotSupportedException
   */
  public function delete(Query $query): void {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->deleteById(
        $query->getId(),
      ),
      default => throw new QueryNotSupportedException()
    };

    $this->pdo->transaction($sql->sql(), $sql->params());
  }
}
