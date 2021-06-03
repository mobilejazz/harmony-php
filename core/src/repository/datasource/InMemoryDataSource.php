<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\error\DataNotFoundException;
use harmony\core\repository\error\QueryNotSupportedException;
use harmony\core\repository\query\AllQuery;
use harmony\core\repository\query\KeyQuery;
use harmony\core\repository\query\Query;
use InvalidArgumentException;

/**
 * @template   T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 */
class InMemoryDataSource implements GetDataSource, PutDataSource, DeleteDataSource {
  /** @var array<mixed, T> */
  protected $entities = [];

  /**
   * @psalm-param class-string<T> $genericClass
   *
   * @param string                $genericClass
   */
  public function __construct(
    protected string $genericClass
  ) {
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
