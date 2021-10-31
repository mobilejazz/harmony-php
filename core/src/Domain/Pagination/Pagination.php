<?php

namespace Harmony\Core\Domain\Pagination;

/**
 * @template T
 */
class Pagination {
  /**
   * @param array<T> $values
   */
  public function __construct(public array $values) {
  }
}
