<?php

namespace harmony\core\Module\Sql\Query;

interface PaginationSqlQuery extends ComposedSqlQuery {
  public function offset(): int;

  public function limit(): int;
}
