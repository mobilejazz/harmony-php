<?php

namespace Harmony\Core\Data\Query\Composed;

interface PaginationOffsetLimitQuery extends ComposedQuery {
  public function offset(): int;

  public function limit(): int;
}
