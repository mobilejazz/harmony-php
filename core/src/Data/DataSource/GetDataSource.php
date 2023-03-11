<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
interface GetDataSource {
  /**
   * @return T
   */
  public function get(Query $query): mixed;
}
