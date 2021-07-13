<?php

namespace Harmony\Core\Module\Sql\Query;

interface PaginationSqlQuery extends ComposedSqlQuery {
  public function offset(): int;

  public function limit(): int;
}
