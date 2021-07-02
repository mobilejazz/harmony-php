<?php

namespace Harmony\Core\Repository\Mapper;

interface Mapper {
  /**
   * @param mixed $from
   *
   * @return mixed
   */
  public function map($from);
}
