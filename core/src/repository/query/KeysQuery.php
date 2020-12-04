<?php

namespace harmony\core\repository\query;

class KeysQuery extends Query
{
    /** @var array<string> */
    private $keys;

    /**
     * @param array<string> $keys
     */
    public function __construct(array $keys)
    {
        $this->keys = $keys;
    }

    /**
     * @return array<string>
     */
    public function getKeys(): array
    {
        return $this->keys;
    }
}
