<?php

namespace Harmony\Core\Domain\Pagination;

/**
 * @psalm-immutable
 * @template T
 */
class Pagination {
  /**
   * @param array<T> $values
   */
  public function __construct(public array $values) {
  }
}
