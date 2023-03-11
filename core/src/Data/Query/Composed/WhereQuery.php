<?php

namespace Harmony\Core\Data\Query\Composed;

use Harmony\Core\Data\Query\Criteria\WhereCriteria;

interface WhereQuery extends ComposedQuery {
  /**
   * @return WhereCriteria[]
   */
  public function where(): array;
}
