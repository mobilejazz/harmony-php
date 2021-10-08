<?php

namespace Harmony\Core\Domain\Pagination;

/**
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
        protected array $values,
        protected int $offset,
        protected int $limit,
        protected int $size,
    ) {
        parent::__construct($values);
    }

    public function getOffset(): int {
        return $this->offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}
