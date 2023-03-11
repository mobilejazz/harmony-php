<?php

namespace Harmony\Core\Data\Query;

class IdsQuery implements Query {
  /**
   * @param int[]|string[] $ids
   */
  public function __construct(public readonly array $ids) {
  }
}
