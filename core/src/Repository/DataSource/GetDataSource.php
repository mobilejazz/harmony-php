<?php

namespace harmony\core\Repository\DataSource;

use harmony\core\Repository\Query\Query;

/**
 * @template T
 */
interface GetDataSource {
  /**
   * @param Query $query
   *
   * @return T
   */
  public function get(Query $query): mixed;

  /**
   * @param Query $query
   *
   * @return array<T>
   */
  public function getAll(Query $query): array;
}
