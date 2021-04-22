<?php

namespace harmony\core\repository\mapper;

interface Mapper {
  /**
   * @param mixed $from
   *
   * @return mixed
   */
  public function map($from);
}
