<?php

namespace Harmony\Core\Repository\Query\Composed;

trait PaginationOffsetLimitTrait {
  public function __construct(
    public readonly int $offset,
    public readonly int $limit,
    public readonly string $orderBy,
    public readonly bool $ascending,
  ) {
  }
}
