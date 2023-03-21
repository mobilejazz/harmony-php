<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;

interface DeleteDataSource {
  public function delete(Query $query): void;
}
