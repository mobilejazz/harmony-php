<?php

namespace harmony\core\shared\collection;

use Countable;
use Iterator;
use JsonSerializable;

class Collection implements Iterator, Countable, JsonSerializable
{
    // TODO: new functions like: "add", "get"...
    // @see https://laravel.com/docs/5.8/collections

    /** @var array|iterable */
    private $container;

    /** @var int */
    private $position;

    /**
     * @param iterable $items
     */
    public function __construct(iterable $items)
    {
        $this->container = $items;
        $this->position = 0;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->container);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->container[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->container[$this->position]);
    }

    /**
     * @return array|iterable|mixed
     */
    public function jsonSerialize()
    {
        return $this->container;
    }
}
