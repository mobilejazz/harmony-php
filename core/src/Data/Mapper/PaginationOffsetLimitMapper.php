<?php

namespace Harmony\Core\Data\Mapper;

use Harmony\Core\Domain\Pagination\PaginationOffsetLimit;

/**
 * @template       TFrom
 * @template       TTo
 * @implements Mapper<PaginationOffsetLimit<TFrom>, PaginationOffsetLimit<TTo>>
 * @psalm-suppress InvalidArgument
 * @psalm-suppress UndefinedDocblockClass
 * @psalm-suppress InvalidReturnType
 * @psalm-suppress InvalidReturnStatement
 */
class PaginationOffsetLimitMapper implements Mapper {
  public function __construct(
    /**
     * @var Mapper<TFrom, TTo> $mapper
     */
    protected readonly Mapper $mapper,
  ) {
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
