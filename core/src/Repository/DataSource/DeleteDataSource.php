<?php

namespace harmony\core\Repository\DataSource;

use harmony\core\Repository\Query\Query;

interface DeleteDataSource {
  /**
   * @param Query $query
   *
   * @return void
   */
  public function delete(Query $query): void;
}
