<?php

namespace harmony\core\Repository\Query;

class IdsQuery implements Query {
  /** @var array<int> */
  private $ids;

  /**
   * @param array<int> $ids
   */
  public function __construct(array $ids) {
    $this->ids = $ids;
  }

  /**
   * @return array<int>
   */
  public function getIds(): array {
    return $this->ids;
  }
}
