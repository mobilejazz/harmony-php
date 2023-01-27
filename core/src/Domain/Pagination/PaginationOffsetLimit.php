<?php

namespace Harmony\Core\Domain\Pagination;

/**
 * @template       T
 * @extends Pagination<T>
 * @psalm-suppress UndefinedDocblockClass
 */
class PaginationOffsetLimit extends Pagination {
  public function __construct(
    /**
     * @var T[]       $values
     */
    array $values,
    public readonly int $offset,
    public readonly int $limit,
    public readonly int $size,
  ) {
    parent::__construct($values);
  }
}
