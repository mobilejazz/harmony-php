<?php

namespace Harmony\Core\Data\Query\Composed;

interface OrderByQuery extends ComposedQuery {
  public function orderBy(): string;

  public function ascending(): bool;
}
