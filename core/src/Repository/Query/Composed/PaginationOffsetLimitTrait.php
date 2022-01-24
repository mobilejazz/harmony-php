<?php

namespace Harmony\Core\Repository\Query\Composed;

trait PaginationOffsetLimitTrait
{
    protected int $offset;
    protected int $limit;

    public function offset(): int
    {
        return $this->offset;
    }

    public function limit(): int
    {
        return $this->limit;
    }
}
