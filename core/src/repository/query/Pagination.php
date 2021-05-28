<?php

namespace harmony\core\repository\query;

interface Pagination {
  public function offset(): int;

  public function limit(): int;
}
