<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Query\Query;

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
