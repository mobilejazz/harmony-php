<?php

namespace harmony\core\shared\collection;

use ArrayObject;
use harmony\core\shared\generics\GenericsHelper;

/**
 * @template T
 * @extends ArrayObject<int, T>
 */
class GenericCollection extends ArrayObject
{
    use GenericsHelper;

    /**
     * @psalm-var class-string<T>
     * @var string
     */
    protected $type;

    /**
     * @psalm-param class-string<T> $type
     * @psalm-param array<mixed, T> $input
     * @param string $type
     * @param array  $input
     */
    public function __construct(
        string $type,
        array $input = []
    ) {
        $this->type = $type;
        $this->validateArrayOfGenericArguments($input);

        parent::__construct($input);
    }

    /**
     * @psalm-param T $item
     * @param mixed $item
     */
    public function add($item): void
    {
        $this->validateGenericArgumentOrFail($item);
        $this->append($item);
    }

    /**
     * @param array<mixed> $array
     */
    protected function validateArrayOfGenericArguments(array $array): void
    {
        foreach ($array AS $object) {
            $this->validateGenericArgumentOrFail($object);
        }
    }

    /**
     * @param mixed $object
     */
    protected function validateGenericArgumentOrFail($object): void
    {
        $this->isReceivedObjectLikeExpectedOrFail($object, $this->type);
    }

    /**
     * @psalm-return class-string<T>
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
