<?php

namespace Harmony\Core\Repository\Query;

class IdQuery implements Query {
  public function __construct(protected mixed $id) {
  }

  public function getId(): mixed {
    return $this->id;
  }
}
