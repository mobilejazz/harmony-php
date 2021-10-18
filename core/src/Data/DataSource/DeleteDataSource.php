<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;

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
