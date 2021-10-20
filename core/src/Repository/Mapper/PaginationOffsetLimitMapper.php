<?php

namespace Harmony\Core\Repository\Mapper;

use Harmony\Core\Domain\Pagination\PaginationOffsetLimit;

/**
 * @template TFrom
 * @template TTo
 * @implements Mapper<PaginationOffsetLimit<TFrom>, PaginationOffsetLimit<TTo>>
 */
Class PaginationOffsetLimitMapper implements Mapper {
    /**
     * @param Mapper<TFrom, TTo> $mapper
     */
    public function __construct(
        protected Mapper $mapper,
    ) {
    }

    /**
     * @param PaginationOffsetLimit<TFrom> $from
     * @return PaginationOffsetLimit<TTo>
     */
    public function map(mixed $from): PaginationOffsetLimit {
        return new PaginationOffsetLimit(
            array_map(function ($value) {
                return $this->mapper->map($value);
            }, $from->getValues()),
            $from->getOffset(),
            $from->getLimit(),
            $from->getSize(),
        );
    }
}
