<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Query\Query;

/**
 * @template T
 */
interface GetDataSource {
  /**
   * @return T
   */
  public function get(Query $query);

  /**
   * @return array<T>
   */
  public function getAll(Query $query): array;

  public function getCount(Query $query): int;
}
