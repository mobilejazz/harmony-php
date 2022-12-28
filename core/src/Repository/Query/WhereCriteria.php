<?php

namespace Harmony\Core\Repository\Query;

/**
 * @psalm-immutable
 */
class WhereCriteria {
  public function __construct(
    public String $field,
    public Criteria $condition,
    public mixed $value = null,
  ) {
  }
}
