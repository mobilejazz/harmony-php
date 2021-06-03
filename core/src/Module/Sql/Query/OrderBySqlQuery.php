<?php

namespace harmony\core\Module\Sql\Query;

interface OrderBySqlQuery extends ComposedSqlQuery {
  public function orderBy(): string;

  public function ascending(): bool;
}
