<?php

namespace Harmony\Core\Repository\Mapper;

use Harmony\Core\Shared\Error\MethodNotImplementedException;

/**
 * @template TFrom
 * @template TTo
 * @implements Mapper<TFrom, TTo>
 */
Class VoidMapper implements Mapper {
    /**
     * @inheritdoc
     */
    public function map(mixed $from) {
        throw new MethodNotImplementedException();
    }
}
