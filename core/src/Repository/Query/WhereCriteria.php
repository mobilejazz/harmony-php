<?php

namespace Harmony\Core\Repository\Query;

class WhereCriteria {
  public function __construct(
    public readonly string $field,
    public readonly Criteria $condition,
    public readonly mixed $value = null,
  ) {
  }
}
