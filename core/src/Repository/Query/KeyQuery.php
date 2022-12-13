<?php

namespace Harmony\Core\Repository\Query;

class KeyQuery implements Query {
  public function __construct(public readonly string $key) {
  }
}
