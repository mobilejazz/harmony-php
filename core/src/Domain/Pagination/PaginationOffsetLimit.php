<?php

namespace Harmony\Core\Domain\Pagination;

/**
 * @template       T
 * @extends Pagination<T>
 * @psalm-suppress UndefinedDocblockClass
 */
class PaginationOffsetLimit extends Pagination {
  /**
  * @param T[] $values
  */
  public function __construct(
    array $values,
    public readonly int $offset,
    public readonly int $limit,
    public readonly int $size,
  ) {
    parent::__construct($values);
  }
}
