<?php

namespace Harmony\Core\Repository\Mapper;

class BlankMapper implements Mapper {
  /**
   * @inheritDoc
   */
  public function map($from) {
    return $from;
  }
}
