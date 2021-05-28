<?php

namespace harmony\core\repository\query;

interface OrderBy {
  public function orderBy(): string;

  public function ascending(): bool;
}
