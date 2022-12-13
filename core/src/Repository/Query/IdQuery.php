<?php

namespace Harmony\Core\Repository\Query;

class IdQuery implements Query {
  public function __construct(public readonly mixed $id) {
  }
}
