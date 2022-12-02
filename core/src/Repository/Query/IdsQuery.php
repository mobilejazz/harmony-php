<?php

namespace Harmony\Core\Repository\Query;

class IdsQuery implements Query {
  /**
   * @param mixed[] $ids
   */
  public function __construct(public readonly array $ids) {
  }
}
