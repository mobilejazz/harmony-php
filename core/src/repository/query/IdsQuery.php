<?php

namespace harmony\core\repository\query;

class IdsQuery extends Query
{
    /** @var array */
    private $ids;

    /**
     * @param array $ids
     */
    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    /**
     * @return array
     */
    public function getIds(): array
    {
        return $this->ids;
    }
}
