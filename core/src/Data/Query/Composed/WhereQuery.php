<?php

namespace Harmony\Core\Data\Query\Composed;

interface WhereQuery extends ComposedQuery {
  /**
   * @return array<string, mixed>
   */
  public function where(): array;
}
