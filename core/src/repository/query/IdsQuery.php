<?php

namespace harmony\core\repository\query;

class IdsQuery extends Query {
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
