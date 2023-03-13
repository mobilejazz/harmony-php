<?php

namespace Harmony\Core\Data\Query;

class IdQuery extends KeyQuery {
  public function __construct(public readonly int|string $id) {
    parent::__construct((string) $id);
  }
}
