<?php

namespace Harmony\Core\Domain\Pagination;

/**
 * @template T
 */
class Pagination {
  /**
   * @param array<T> $values
   */
  public function __construct(
    /** @var array<T> $values */
    public readonly array $values,
  ) {
  }
}
