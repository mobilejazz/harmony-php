<?php

namespace harmony\core\Repository\Query;

class IdQuery extends KeyQuery {
  /** @var mixed */
  private $id;

  /**
   * @param mixed $id
   */
  public function __construct($id) {
    parent::__construct((string) $id);
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }
}
