<?php

namespace Harmony\Core\Repository\Query\Composed;

interface OrderByQuery extends ComposedQuery {
  public function orderBy(): string;

  public function ascending(): bool;
}
