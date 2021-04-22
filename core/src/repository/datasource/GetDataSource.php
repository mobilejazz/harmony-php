<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;

/**
 * @template T
 */
interface GetDataSource {
  /**
   * @param Query $query
   *
   * @return T
   */
  public function get(Query $query);

  /**
   * @param Query $query
   *
   * @return array<T>
   */
  public function getAll(Query $query): array;
}
