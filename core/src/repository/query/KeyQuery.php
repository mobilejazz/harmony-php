<?php

namespace harmony\core\repository\query;

class KeyQuery extends Query
{
    /** @var string */
    private $key;

    /**
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function geKey(): string
    {
        return $this->key;
    }
}
