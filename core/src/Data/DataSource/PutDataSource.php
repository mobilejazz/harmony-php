<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
interface PutDataSource {
  /**
   * @param Query $query
   * @param T     $entity
   *
   * @return T
   */
  public function put(Query $query, mixed $entity): mixed;
}
