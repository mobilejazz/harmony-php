<?php

namespace harmony\core\shared\collection;

use harmony\core\shared\generics\GenericsHelper;

class GenericCollection extends Collection
{
    use GenericsHelper;

    /** @var string */
    protected $generic_name_class;

    /**
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
     * @param $item
     */
    public function add($item): void
    {
        $this->validateGenericArgumentOrFail($item);
        $this->container[] = $item;
    }

    /**
     * @param iterable $array
     */
    protected function validateArrayOfGenericArguments(iterable $array): void
    {
        foreach ($array AS $object) {
            $this->validateGenericArgumentOrFail($object);
        }
    }

    /**
     * @param $object
     */
    protected function validateGenericArgumentOrFail($object): void
    {
        $this->isReceivedObjectLikeExpectedOrFail($object, $this->generic_name_class);
    }

    /**
     * @return string
     */
    public function getGenericNameClass(): string
    {
        return $this->generic_name_class;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->getIterator()->getArrayCopy();
    }

    /**
     * @param mixed $index
     * @param mixed $newval
     */
    public function offsetSet($index, $newval): void
    {
        $this->validateGenericArgumentOrFail($newval);

        parent::offsetSet($index, $newval);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized): void
    {
        parent::unserialize($serialized);

        $this->validateArrayOfGenericArguments($this->getIterator());
    }
}
