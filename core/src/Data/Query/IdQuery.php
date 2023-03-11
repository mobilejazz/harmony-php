<?php

namespace Harmony\Core\Data\Query;

class IdQuery implements Query {
  public function __construct(public readonly int|string $id) {
  }
}
