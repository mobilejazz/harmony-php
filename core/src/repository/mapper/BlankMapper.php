<?php

namespace harmony\core\repository\mapper;

class BlankMapper implements Mapper {
  /**
   * @inheritDoc
   */
  public function map($from) {
    return $from;
  }
}
