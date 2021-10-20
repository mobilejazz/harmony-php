<?php

namespace Harmony\Core\Repository\Query\Composed;

interface WhereQuery extends ComposedQuery {
  /**
   * @return array<string, mixed>
   */
  public function where(): array;
}
