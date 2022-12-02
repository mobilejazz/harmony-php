<?php

namespace Harmony\Core\Repository\Query\Composed;

trait PaginationOffsetLimitTrait {
  protected int $offset;
  protected int $limit;
  protected string $orderBy;
  protected bool $ascending;

  public function offset(): int {
    return $this->offset;
  }

  public function limit(): int {
    return $this->limit;
  }

  public function orderBy(): string {
    return $this->orderBy;
  }

  public function ascending(): bool {
    return $this->ascending;
  }
}
