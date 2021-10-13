<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Query\Query;

/**
 * @template T
 */
interface DeleteDataSource {
  /**
   * @param Query $query
   *
   * @return void
   */
  public function delete(Query $query): void;
}
