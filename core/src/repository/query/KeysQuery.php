<?php

namespace harmony\core\repository\query;

class KeysQuery extends Query
{
    /**
     * @param array<string> $keys
     */
    public function __construct(
        protected array $keys
    ) {
    }

    /**
     * @return array<string>
     */
    public function getKeys(): array
    {
        return $this->keys;
    }
}
