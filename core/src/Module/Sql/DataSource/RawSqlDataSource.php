<?php

namespace Harmony\Core\Module\Sql\DataSource;

use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Exception\DataNotFoundException;
use Harmony\Core\Data\Exception\QueryNotSupportedException;
use Harmony\Core\Data\Query\AllQuery;
use Harmony\Core\Data\Query\Composed\ComposedQuery;
use Harmony\Core\Data\Query\IdQuery;
use Harmony\Core\Data\Query\KeyQuery;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Data\Query\VoidQuery;
use Harmony\Core\Module\Sql\Helper\SqlBuilder;
use InvalidArgumentException;

/**
 * @template T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 * @implements DeleteDataSource<T>
 */
class RawSqlDataSource implements
  GetDataSource,
  PutDataSource,
  DeleteDataSource {
  public function __construct(
    protected SqlInterface $pdo,
    protected SqlBuilder $sqlBuilder,
    /** @var class-string<T> */
    protected string $genericClass,
  ) {
  }

  /**
   * @return T
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function get(Query $query): mixed {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->selectById(
        $query->getId(),
      ),
      $query instanceof KeyQuery => $this->sqlBuilder->selectByKey(
        $query->geKey(),
      ),
      $query instanceof ComposedQuery => $this->sqlBuilder->selectComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException()
    };

    $item = $this->pdo->findOne(
      $sql->sql(),
      $sql->params(),
      $this->genericClass,
    );

    if (!isset($item) || !is_object($item)) {
      throw new DataNotFoundException();
    }

    return $item;
  }

  /**
   * @return T[]
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function getAll(Query $query): array {
    $sql = match (true) {
      $query instanceof AllQuery => $this->sqlBuilder->selectAll(),
      $query instanceof ComposedQuery => $this->sqlBuilder->selectAllComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException()
    };

    $items = $this->pdo->findAll(
      $sql->sql(),
      $sql->params(),
      $this->genericClass,
    );

    if (empty($items)) {
      throw new DataNotFoundException();
    }

    return $items;
  }

  /**
   * @param Query  $query
   * @param T|null $entity
   *
   * @return T
   * @throws QueryNotSupportedException
   */
  public function put(Query $query, mixed $entity = null): mixed {
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
   * @param Query    $query
   * @param T[]|null $entities
   *
   * @return T[]
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
