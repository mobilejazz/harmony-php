<?php

namespace harmony\core\repository\query;

class PaginationOffsetLimitQuery extends Query
{
    /**
     * @param int $offset
     * @param int $limit
     */
    public function __construct(
        protected int $offset,
        protected int $limit
    ) {
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}
