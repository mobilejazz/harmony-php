<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Query\Query;

interface DeleteDataSource {
  /**
   * @param Query $query
   *
   * @return void
   */
  public function delete(Query $query): void;
}
