<?php

namespace Harmony\Core\Repository\Query\Composed;

use Harmony\Core\Repository\Query\WhereCriteria;

interface WhereQuery extends ComposedQuery {
  /**
   * @return WhereCriteria[]
   */
  public function where(): array;
}
