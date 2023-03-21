<?php

namespace Harmony\Core\Data\Query\Criteria;

class WhereCriteria {
  public function __construct(
    public readonly string $field,
    public readonly Criteria $condition,
    public readonly mixed $value = null,
  ) {
  }
}
