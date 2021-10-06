<?php

namespace Harmony\Core\Domain\Pagination;

class PaginationOffsetLimit extends Pagination {
    /**
     * @param array $values
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

    /**
     * @return int
     */
    public function getOffset(): int {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
}
