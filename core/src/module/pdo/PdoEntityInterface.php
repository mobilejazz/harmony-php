<?php

namespace harmony\core\module\pdo;

interface PdoEntityInterface {
  public function getColumnsWithValues(): array;
}
