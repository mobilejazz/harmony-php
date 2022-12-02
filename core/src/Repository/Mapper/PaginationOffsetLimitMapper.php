<?php

namespace Harmony\Core\Repository\Mapper;

use Harmony\Core\Domain\Pagination\PaginationOffsetLimit;

/**
 * @template TFrom
 * @template TTo
 * @implements Mapper<PaginationOffsetLimit<TFrom>, PaginationOffsetLimit<TTo>>
 */
class PaginationOffsetLimitMapper implements Mapper {
  /**
   * @param Mapper<TFrom, TTo> $mapper
   */
  public function __construct(protected readonly Mapper $mapper) {
  }

  /**
   * @param PaginationOffsetLimit<TFrom> $from
   *
   * @return PaginationOffsetLimit<TTo>
   */
  public function map(mixed $from): PaginationOffsetLimit {
    $pagination = new PaginationOffsetLimit(
      array_map(function ($value) {
        return $this->mapper->map($value);
      }, $from->values),
      $from->offset,
      $from->limit,
      $from->size,
    );

    return $pagination;
  }
}
