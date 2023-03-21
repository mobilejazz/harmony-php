<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Query\Query;

interface DeleteDataSource {
  public function delete(Query $query): void;
}
