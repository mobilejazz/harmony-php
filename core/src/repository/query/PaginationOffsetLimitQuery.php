<?php

namespace harmony\core\repository\query;

class PaginationOffsetLimitQuery extends Query
{
    /** @var integer */
    private $offset;
    /** @var integer */
    private $limit;

    /**
     * PaginationOffsetLimitQuery constructor.
     * @param int $offset
     * @param int $limit
     */
    public function __construct(int $offset, int $limit)
    {
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getOffset() : int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit() : int
    {
        return $this->limit;
    }

}
