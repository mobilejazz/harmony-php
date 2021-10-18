<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
interface PutDataSource {
  /**
   * @param Query  $query
   * @param T|null $entity
   *
   * @return T
   */
  public function put(Query $query, mixed $entity = null): mixed;

  /**
   * @param Query         $query
   * @param array<T>|null $entities
   *
   * @return array<T>
   */
  public function putAll(Query $query, array $entities = null): array;
}
