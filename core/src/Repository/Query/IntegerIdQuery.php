<?php

namespace Harmony\Core\Repository\Query;

class IntegerIdQuery extends KeyQuery {
  /** @var int */
  private $id;

  /**
   * @param int $id
   */
  public function __construct(int $id) {
    parent::__construct((string) $id);
    $this->id = $id;
  }

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }
}
