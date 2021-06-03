<?php

namespace harmony\core\module\pdo;

interface PdoEntityInterface {
  /**
   * @return mixed[]
   */
  public function getColumnsWithValues(): array;
}
