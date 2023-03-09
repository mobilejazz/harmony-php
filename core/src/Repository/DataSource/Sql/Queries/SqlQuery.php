<?php

namespace Harmony\Core\Repository\DataSource\Sql\Queries;

use Harmony\Core\Repository\Query\Query;

interface SqlQuery extends Query {
  public function getValues(): array;
}
