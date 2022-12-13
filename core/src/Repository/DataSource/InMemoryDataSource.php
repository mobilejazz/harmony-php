<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Error\DataNotFoundException;
use Harmony\Core\Repository\Error\QueryNotSupportedException;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use Harmony\Core\Repository\Query\Query;
use InvalidArgumentException;

/**
 * @see        InMemoryProductInteractorsTest
 *
 * @template   T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 */
class InMemoryDataSource implements
  GetDataSource,
  PutDataSource,
  DeleteDataSource {
  /** @var array<mixed, T> */
  protected array $entities = [];

  /**
   * @psalm-param class-string<T> $genericClass
   *
   * @param string                $genericClass
   */
  public function __construct(protected readonly string $genericClass) {
  }

  /**
   * @inheritdoc
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function get(Query $query): mixed {
    if ($query instanceof KeyQuery) {
      if (!isset($this->entities[$query->key])) {
        throw new DataNotFoundException();
      }

      return $this->entities[$query->key];
    }

    throw new QueryNotSupportedException();
  }

  /**
   * @inheritdoc
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
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
   * @throws QueryNotSupportedException
   */
  public function put(Query $query, mixed $entity = null): mixed {
    if ($entity === null) {
      throw new InvalidArgumentException();
    }

    if ($query instanceof KeyQuery) {
      $this->entities[$query->key] = $entity;

      return $entity;
    }

    throw new QueryNotSupportedException();
  }

  /**
   * @inheritdoc
   * @throws QueryNotSupportedException
   */
  public function putAll(Query $query, array $entities = null): array {
    if ($entities === null) {
      throw new InvalidArgumentException();
    }

    if ($query instanceof AllQuery) {
      foreach ($entities as $entity) {
        if (!empty($entity->id)) {
          $this->entities[$entity->id] = $entity;
        } else {
          $this->entities[] = $entity;
        }
      }

      return $entities;
    }

    throw new QueryNotSupportedException();
  }

  /**
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function delete(Query $query): void {
    if ($query instanceof KeyQuery) {
      if (!isset($this->entities[$query->key])) {
        throw new DataNotFoundException();
      }

      unset($this->entities[$query->key]);

      return;
    }

    throw new QueryNotSupportedException();
  }
}
