<?php

namespace Harmony\Core\Data\Query;

class KeyQuery implements Query {
  public function __construct(public readonly string $key) {
  }
}
