<?php

namespace harmony\core\shared\collection;

use harmony\core\shared\error\InvalidArgumentException;

class GenericCollection extends Collection
{
    /** @var string */
    protected $generic_name_class;

    /**
     * GenericCollection constructor.
     *
     * @param string   $generic_name_class
     * @param iterable $input
     */
    public function __construct(string $generic_name_class, iterable $input = [])
    {
        $this->generic_name_class = $generic_name_class;
        $this->validateArrayOfGenericArguments($input);

        parent::__construct($input);
    }

    /**
     * @return string
     */
    public function getGenericNameClass()
    {
        return $this->generic_name_class;
    }

    /**
     * @param mixed $index
     * @param mixed $newval
     */
    public function offsetSet($index, $newval)
    {
        $this->validateGenericArgument($newval);

        parent::offsetSet($index, $newval);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        parent::unserialize($serialized);

        $this->validateArrayOfGenericArguments($this->getIterator());
    }

    /**
     * @param iterable $array
     */
    protected function validateArrayOfGenericArguments(iterable $array)
    {
        foreach ($array AS $object) {
            $this->validateGenericArgument($object);
        }
    }

    /**
     * @param $object
     */
    protected function validateGenericArgument($object)
    {
        if (!$object instanceof $this->generic_name_class) {
            throw new InvalidArgumentException($this->generic_name_class, get_class($object));
        }
    }
}
