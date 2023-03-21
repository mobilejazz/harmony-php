<?php

namespace Harmony\Core\Repository\Query;

class IntegerIdQuery implements Query {
  public function __construct(public readonly int $id) {
  }
}
