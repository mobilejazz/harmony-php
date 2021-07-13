<?php

namespace Harmony\Core\Repository\Mapper;

/**
 * @template TFrom
 * @template TTo
 */
interface Mapper {
  /**
   * @param TFrom $from
   *
   * @return TTo
   */
  public function map(mixed $from);
}
