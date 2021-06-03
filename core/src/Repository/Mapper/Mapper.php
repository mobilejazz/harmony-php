<?php

namespace harmony\core\Repository\Mapper;

interface Mapper {
  /**
   * @param mixed $from
   *
   * @return mixed
   */
  public function map($from);
}
