<?php

namespace harmony\core\repository\mapper;

use harmony\core\shared\generics\GenericsHelper;

abstract class GenericMapper implements Mapper
{
    use GenericsHelper;

    /** @var string */
    protected $from;
    /** @var string */
    protected $to;

    public function __construct(string $from_class, string $to_class)
    {
        $this->from = $from_class;
        $this->to = $to_class;
    }

    /**
     * @return string
     */
    public function getTypeFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTypeTo(): string
    {
        return $this->to;
    }

    /**
     * @param $from
     *
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
     * @param $from
     *
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
     * @param object $object
     *
     * @return bool
     */
    protected function isTypeToOrFail(object $object): bool
    {
        return $this->isReceivedObjectLikeExpectedOrFail($object, $this->to);
    }
}
