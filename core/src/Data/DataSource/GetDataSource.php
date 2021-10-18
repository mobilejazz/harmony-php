<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;

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
