<?php

namespace Harmony\Core\Domain\Pagination;

/**
 * @template T
 * @extends Pagination<T>
 */
class PaginationOffsetLimit extends Pagination {
  /**
   * @param array<T> $values
   */
  public function __construct(
    /** @var array<T> $values */
    public readonly array $values,
    public readonly int $offset,
    public readonly int $limit,
    public readonly int $size,
  ) {
    parent::__construct($values);
  }
}
