<?php

namespace harmony\core\Repository\Mapper;

class BlankMapper implements Mapper {
  /**
   * @inheritDoc
   */
  public function map($from) {
    return $from;
  }
}
