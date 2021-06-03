<?php

namespace harmony\core\Repository\Query;

class KeysQuery implements Query {
  /**
   * @param array<string> $keys
   */
  public function __construct(
    protected array $keys
  ) {
  }

  /**
   * @return array<string>
   */
  public function getKeys(): array {
    return $this->keys;
  }
}
