<?php

namespace Harmony\Core\Module\Memory\DataSource;

use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Error\DataNotFoundException;
use Harmony\Core\Data\Error\QueryNotSupportedException;
use Harmony\Core\Data\Query\AllQuery;
use Harmony\Core\Data\Query\KeyQuery;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Data\Query\VoidQuery;
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

    if ($query instanceof AllQuery) {
      if (empty($this->entities)) {
        throw new DataNotFoundException();
      }

      // @phpstan-ignore-next-line
      return array_values($this->entities);
    }

    throw new QueryNotSupportedException($query);
  }

  /**
   * @inheritdoc
   * @throws QueryNotSupportedException
   */
  public function put(Query $query = null, mixed $entities = null): mixed {
    if ($entities === null) {
      throw new InvalidArgumentException();
    }

    if ($query instanceof KeyQuery) {
      $this->entities[$query->key] = $entities;

      return $entities;
    }

    if ($query instanceof AllQuery) {
      foreach ($entities as $toFind) {
        // @phpstan-ignore-next-line
        if (isset($toFind->id) && !empty((string) $toFind->id)) {
          // @phpstan-ignore-next-line
          $this->entities[(string) $toFind->id] = $toFind;
        } else {
          $this->entities[] = $toFind;
        }
      }

      return $entities;
    }

    throw new QueryNotSupportedException($query ?? new VoidQuery());
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

    throw new QueryNotSupportedException($query);
  }
}
