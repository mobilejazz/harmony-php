<?php

namespace Harmony\Core\Repository\Query\Composed;

interface PaginationOffsetLimitQuery extends ComposedQuery {
  public function offset(): int;

  public function limit(): int;
}
