<?php

namespace harmony\core\repository\mapper;

use harmony\core\repository\BaseEntity;
use harmony\core\shared\generics\GenericsHelper;

/**
 * @template Tfrom
 * @template Tto
 */
abstract class GenericMapper implements Mapper
{
    use GenericsHelper;

    /**
     * @psalm-var class-string<Tfrom>
     * @var string
     */
    protected $from;
    /**
     * @psalm-var class-string<Tto>
     * @var string
     */
    protected $to;

    /**
     * @psalm-param class-string<Tfrom> $from_class
     * @psalm-param class-string<Tto> $to_class
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
     * @psalm-return class-string<Tfrom>
     * @return string
     */
    public function getTypeFrom(): string
    {
        return $this->from;
    }

    /**
     * @psalm-return class-string<Tto>
     * @return string
     */
    public function getTypeTo(): string
    {
        return $this->to;
    }

    /**
     * @psalm-param  Tfrom $from
     *
     * @param mixed $from
     *
     * @psalm-return Tto
     * @return BaseEntity
     */
    public function map($from)
    {
        $this->isTypeFromOrFail($from);

        $to = $this->overrideMap($from);
        $this->isTypeToOrFail($to);

        return $to;
    }

    /**
     * @psalm-param  Tfrom $from
     *
     * @param mixed $from
     *
     * @psalm-return Tto
     * @return BaseEntity
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
