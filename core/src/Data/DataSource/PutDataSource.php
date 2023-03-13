<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
interface PutDataSource {
  /**
   * @param Query|null $query
   * @param T|null     $entity
   *
   * @return T
   */
  public function put(Query $query = null, mixed $entity = null): mixed;
}
