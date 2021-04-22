<?php

namespace harmony\core\repository\query;

class KeyQuery extends Query {
  /**
   * @param string $key
   */
  public function __construct(
    protected string $key
  ) {
  }

  /**
   * @return string
   */
  public function geKey(): string {
    return $this->key;
  }
}
