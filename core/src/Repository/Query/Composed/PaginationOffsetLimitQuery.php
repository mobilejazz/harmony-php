<?php

namespace Harmony\Core\Repository\Query\Composed;

interface PaginationOffsetLimitQuery extends ComposedQuery, OrderByQuery {
  public function offset(): int;

  public function limit(): int;
}
