<?php

namespace Harmony\Core\Repository\DataSource\Sql\DataSource;

use Harmony\Core\Repository\DataSource\DeleteDataSource;
use Harmony\Core\Repository\DataSource\GetDataSource;
use Harmony\Core\Repository\DataSource\PutDataSource;
use Harmony\Core\Repository\DataSource\Sql\Helper\SqlBuilder;
use Harmony\Core\Repository\DataSource\Sql\Queries\InsertSqlQuery;
use Harmony\Core\Repository\DataSource\Sql\Queries\PatchSqlQuery;
use Harmony\Core\Repository\DataSource\Sql\Queries\SqlQuery;
use Harmony\Core\Repository\Error\DataNotFoundException;
use Harmony\Core\Repository\Error\QueryNotSupportedException;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\Composed\ComposedQuery;
use Harmony\Core\Repository\Query\Composed\CountQuery;
use Harmony\Core\Repository\Query\IdQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Repository\Query\VoidQuery;
use InvalidArgumentException;

/**
 * @see RawSqlProductInteractorsTest
 *
 * @implements GetDataSource<object>
 * @implements PutDataSource<object>
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
    protected readonly SqlInterface $pdo,
    protected readonly SqlBuilder $sqlBuilder,
  ) {
  }

  /**
   * @psalm-suppress LessSpecificImplementedReturnType
   *
   * @param Query $query
   *
   * @return mixed
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function get(Query $query): mixed {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->selectById($query->id),
      $query instanceof KeyQuery => $this->sqlBuilder->selectByKey($query->key),
      $query instanceof ComposedQuery => $this->sqlBuilder->selectComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException(),
    };

    $item = $this->pdo->findOne($sql->sql(), $sql->params());

    if ($item === null) {
      throw new DataNotFoundException();
    }

    if ($query instanceof CountQuery) {
      // @phpstan-ignore-next-line
      $item = $item->count;
    }

    return $item;
  }

  /**
   * @psalm-suppress LessSpecificImplementedReturnType
   *
   * @param Query $query
   *
   * @return mixed[]
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function getAll(Query $query): array {
    $sql = match (true) {
      $query instanceof AllQuery => $this->sqlBuilder->selectAll(),
      $query instanceof ComposedQuery => $this->sqlBuilder->selectAllComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException(),
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
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function put(Query $query, mixed $entity = null): mixed {
    if ($query instanceof SqlQuery) {
      return $this->queryPut($query);
    }

    $id = $this->getId($query, $entity);

    try {
      if (!empty($id)) {
        $currentData = $this->get(new IdQuery($id));
      }
    } catch (DataNotFoundException) {
      $currentData = null;
    }

    $isInsertion = empty($id) || empty($currentData);

    if ($isInsertion) {
      $sql = $this->sqlBuilder->insert($entity);
      $id = $this->pdo->insert($sql->sql(), $sql->params());
    } else {
      $sql = $this->sqlBuilder->updateById($id, $entity);
      $this->pdo->execute($sql->sql(), $sql->params());
    }

    return $this->get(new IdQuery($id));
  }

  /**
   * @throws QueryNotSupportedException
   * @throws DataNotFoundException
   */
  public function queryPut(SqlQuery $query): mixed {
    switch (true) {
      case $query instanceof InsertSqlQuery:
        $sql = $this->sqlBuilder->insert(null, $query);
        $id = $this->pdo->insert($sql->sql(), $sql->params());
        return $this->get(new IdQuery($id));
      case $query instanceof PatchSqlQuery:
        $sql = $this->sqlBuilder->patch($query);
        $this->pdo->execute($sql->sql(), $sql->params());
        return $this->get($query);
      default:
        throw new QueryNotSupportedException();
    }
  }

  /**
   * @param Query      $query
   * @param mixed|null $entity
   *
   * @return mixed
   */
  public function getId(Query $query, mixed $entity = null): mixed {
    $id = null;
    $idColumnName = $this->sqlBuilder->getSchema()->getIdColumn();

    if ($query instanceof IdQuery) {
      $id = $query->id;
    } elseif (!empty($entity?->$idColumnName)) {
      $id = $entity->$idColumnName;
    }

    return $id;
  }

  /**
   * @psalm-suppress LessSpecificImplementedReturnType
   *
   * @param Query         $query
   * @param object[]|null $entities
   *
   * @return mixed[]
   * @throws QueryNotSupportedException|DataNotFoundException
   */
  public function putAll(Query $query, array $entities = null): array {
    if ($entities === null) {
      throw new InvalidArgumentException();
    }

    if ($query instanceof AllQuery) {
      $insertedEntities = [];

      foreach ($entities as $entity) {
        $insertedEntities[] = $this->put(new VoidQuery(), $entity);
      }

      return $insertedEntities;
    }

    $sql = match (true) {
      $query instanceof VoidQuery => $this->sqlBuilder->multiInsert($entities),
      default => throw new QueryNotSupportedException(),
    };

    $this->pdo->execute($sql->sql(), $sql->params());

    return $entities;
  }

  /**
   * @param Query $query
   *
   * @throws QueryNotSupportedException
   */
  public function delete(Query $query): void {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->deleteById($query->id),
      $query instanceof KeyQuery => $this->sqlBuilder->deleteByKey($query->key),
      $query instanceof ComposedQuery => $this->sqlBuilder->deleteComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException(),
    };

    $this->pdo->execute($sql->sql(), $sql->params());
  }
}
