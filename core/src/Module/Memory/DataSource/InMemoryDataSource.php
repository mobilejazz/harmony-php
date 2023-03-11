<?php

namespace Harmony\Core\Module\Memory\DataSource;

use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Error\DataNotFoundException;
use Harmony\Core\Data\Error\QueryNotSupportedException;
use Harmony\Core\Data\Query\AllQuery;
use Harmony\Core\Data\Query\IdQuery;
use Harmony\Core\Data\Query\Query;
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
    if ($query instanceof IdQuery) {
      if (!isset($this->entities[$query->id])) {
        throw new DataNotFoundException();
      }

      return $this->entities[$query->id];
    }

    if ($query instanceof AllQuery) {
      if (empty($this->entities)) {
        throw new DataNotFoundException();
      }

      return $this->entities;
    }

    throw new QueryNotSupportedException($query);
  }

  /**
   * @inheritdoc
   * @throws QueryNotSupportedException
   */
  public function put(Query $query, mixed $entity = null): mixed {
    if ($entity === null) {
      throw new InvalidArgumentException();
    }

    if ($query instanceof IdQuery) {
      $this->entities[$query->id] = $entity;

      return $entity;
    }

    if ($query instanceof AllQuery) {
      foreach ($entity as $toFind) {
        if (!empty($toFind->id)) {
          $this->entities[$toFind->id] = $toFind;
        } else {
          $this->entities[] = $toFind;
        }
      }

      return $entity;
    }

    throw new QueryNotSupportedException($query);
  }

  /**
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function delete(Query $query): void {
    if ($query instanceof IdQuery) {
      if (!isset($this->entities[$query->id])) {
        throw new DataNotFoundException();
      }

      unset($this->entities[$query->id]);

      return;
    }

    throw new QueryNotSupportedException($query);
  }
}
