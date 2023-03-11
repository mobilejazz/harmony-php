<?php

namespace Harmony\Core\Data\Query;

class KeysQuery implements Query {
  /**
   * @param string[] $keys
   */
  public function __construct(public readonly array $keys) {
  }
}
