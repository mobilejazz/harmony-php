<?php

namespace harmony\core\repository\query;

class KeysQuery extends Query
{
    /** @var array */
    private $keys;

    /**
     * @param array $keys
     */
    public function __construct(array $keys)
    {
        $this->keys = $keys;
    }

    /**
     * @return array
     */
    public function getKeys(): array
    {
        return $this->keys;
    }
}
