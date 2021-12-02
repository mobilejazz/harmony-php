<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Exception\DataNotFoundException;
use Harmony\Core\Data\Exception\QueryNotSupportedException;
use Harmony\Core\Data\Query\AllQuery;
use Harmony\Core\Data\Query\KeyQuery;
use Harmony\Core\Data\Query\Query;
use InvalidArgumentException;

/**
 * @template   T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 * @implements DeleteDataSource<T>
 */
class InMemoryDataSource implements
  GetDataSource,
  PutDataSource,
  DeleteDataSource {
  /** @var array<mixed, T> */
  protected $entities = [];

  /**
   * @param class-string<T> $genericClass
   */
  public function __construct(protected string $genericClass) {
  }

  /**
   * @inheritdoc
   */
  public function get(Query $query): mixed {
    if ($query instanceof KeyQuery) {
      if (!isset($this->entities[$query->geKey()])) {
        throw new DataNotFoundException();
      }

      return $this->entities[$query->geKey()];
    }

    throw new QueryNotSupportedException();
  }

  /**
   * @inheritdoc
   */
  public function getAll(Query $query): array {
    if ($query instanceof AllQuery) {
      if (empty($this->entities)) {
        throw new DataNotFoundException();
      }

      return $this->entities;
    }

    throw new QueryNotSupportedException();
  }

  /**
   * @inheritdoc
   */
  public function put(Query $query, mixed $entity = null): mixed {
    if ($entity === null) {
      throw new InvalidArgumentException();
    }

    if ($query instanceof KeyQuery) {
      $this->entities[$query->geKey()] = $entity;

      return $entity;
    }

    throw new QueryNotSupportedException();
  }

  /**
   * @inheritdoc
   */
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

  /**
   * @inheritdoc
   */
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
