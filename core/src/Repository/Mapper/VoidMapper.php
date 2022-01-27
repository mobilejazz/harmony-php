<?php

namespace Harmony\Core\Repository\Mapper;

use Harmony\Core\Shared\Error\MethodNotImplementedException;

/**
 * @template TFrom
 * @template TTo
 * @implements Mapper<TFrom, TTo>
 */
class VoidMapper implements Mapper {
  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function map(mixed $from) {
    throw new MethodNotImplementedException();
  }
}