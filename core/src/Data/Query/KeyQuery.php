<?php

namespace Harmony\Core\Data\Query;

class KeyQuery implements Query {
  /**
   * @param string $key
   */
  public function __construct(protected string $key) {
  }

  /**
   * @return string
   */
  public function geKey(): string {
    return $this->key;
  }
}
