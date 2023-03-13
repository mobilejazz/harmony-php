<?php

namespace Harmony\Core\Data\Mapper;

use InvalidArgumentException;

/**
 * @template TFrom
 * @template TTo
 * @implements Mapper<TFrom, TTo>
 */
class ArrayMapper implements Mapper {
  /** @phpstan-ignore-next-line */
  public function __construct(protected readonly Mapper $mapper) {
  }

  /**
   * @inheritdoc
   */
  public function map(mixed $from): mixed {
    if (!is_array($from)) {
      throw new InvalidArgumentException("ArrayMapper can only map arrays");
    }

    // @phpstan-ignore-next-line
    return array_map(fn($item): mixed => $this->mapper->map($item), $from);
  }
}
