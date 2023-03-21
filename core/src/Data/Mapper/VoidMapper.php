<?php

namespace Harmony\Core\Data\Mapper;

use Harmony\Core\Error\MethodNotImplementedException;

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
