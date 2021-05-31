<?php

namespace harmony\core\repository\query;

interface Where {
  /**
   * @return array<string, mixed>
   */
  public function where(): array;
}
