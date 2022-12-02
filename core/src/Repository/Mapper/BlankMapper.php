<?php

namespace Harmony\Core\Repository\Mapper;

/**
 * @template T
 * @implements Mapper<T, T>
 */
class BlankMapper implements Mapper {
  /**
   * @param T $from
   *
   * @return T
   */
  public function map(mixed $from): mixed {
    return $from;
  }
}
