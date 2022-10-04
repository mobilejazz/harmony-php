<?php

namespace Harmony\Core\Domain\Pagination;

/**
 * @psalm-immutable
 * @template T
 * @extends Pagination<T>
 */
class PaginationOffsetLimit extends Pagination {
  /**
   * @param array<T> $values
   * @param int $offset
   * @param int $limit
   * @param int $size
   */
  public function __construct(
    array $values,
    public int $offset,
    public int $limit,
    public int $size,
  ) {
    parent::__construct($values);
  }
}
