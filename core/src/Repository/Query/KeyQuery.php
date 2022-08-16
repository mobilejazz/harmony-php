<?php

namespace Harmony\Core\Repository\Query;

class KeyQuery implements Query {
  /**
   * @param string $key
   */
  public function __construct(protected string $key) {
  }

  /**
   * @return string
   */
  public function getKey(): string {
    return $this->key;
  }
}
