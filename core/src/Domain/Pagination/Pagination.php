<?php

namespace Harmony\Core\Domain\Pagination;

/**
 * @template       T
 * @psalm-suppress UndefinedDocblockClass
 */
class Pagination {
  public function __construct(
    /**
     * @var T[] $values
     */
    public readonly array $values,
  ) {
  }
}
