<?php

namespace harmony\core\repository\mapper;

use harmony\core\shared\generics\GenericsHelper;

/**
 * @template TFrom
 * @template TTo
 */
abstract class GenericMapper implements Mapper
{
    use GenericsHelper;

    /**
     * @psalm-var class-string<TFrom>
     * @var string
     */
    protected $from;
    /**
     * @psalm-var class-string<TTo>
     * @var string
     */
    protected $to;

    /**
     * @psalm-param class-string<TFrom> $from_class
     * @psalm-param class-string<TTo> $to_class
     *
     * @param string $from_class
     * @param string $to_class
     */
    public function __construct(string $from_class, string $to_class)
    {
        $this->from = $from_class;
        $this->to = $to_class;
    }

    /**
     * @psalm-return class-string<TFrom>
     * @return string
     */
    public function getTypeFrom(): string
    {
        return $this->from;
    }

    /**
     * @psalm-return class-string<TTo>
     * @return string
     */
    public function getTypeTo(): string
    {
        return $this->to;
    }

    /**
     * @psalm-param  TFrom $from
     *
     * @param mixed $from
     *
     * @psalm-return TTo
     * @return mixed
     */
    public function map($from)
    {
        $this->isTypeFromOrFail($from);

        $to = $this->overrideMap($from);
        $this->isTypeToOrFail($to);

        return $to;
    }

    /**
     * @psalm-param  TFrom $from
     *
     * @param mixed $from
     *
     * @psalm-return TTo
     * @return mixed
     */
    abstract protected function overrideMap($from);

    /**
     * @param mixed $object
     *
     * @return bool
     */
    protected function isTypeFromOrFail($object): bool
    {
        return $this->isReceivedObjectLikeExpectedOrFail($object, $this->from);
    }

    /**
     * @param mixed $object
     *
     * @return bool
     */
    protected function isTypeToOrFail($object): bool
    {
        return $this->isReceivedObjectLikeExpectedOrFail($object, $this->to);
    }
}
